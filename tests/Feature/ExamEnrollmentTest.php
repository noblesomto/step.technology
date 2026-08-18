<?php

namespace Tests\Feature;

use App\Mail\ExamResultApprovedMail;
use App\Models\Admin;
use App\Models\ExamBatch;
use App\Models\ExamScore;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ExamEnrollmentTest extends TestCase
{
    use RefreshDatabase;

    protected function asAdmin()
    {
        $admin = Admin::factory()->create();
        return $this->withSession(['admin_id' => $admin->admin_id]);
    }

    // ---------- Batches ----------

    public function test_admin_can_create_an_exam_batch(): void
    {
        $response = $this->asAdmin()->post('/admin/exam-batches', [
            'name' => 'June 2026 Sitting',
            'starts_at' => '2026-06-01',
            'ends_at' => '2026-06-30',
        ]);

        $response->assertRedirect('/admin/exam-batches');
        $this->assertDatabaseHas('exam_batches', ['name' => 'June 2026 Sitting']);
    }

    public function test_activating_a_batch_closes_any_other_open_batch(): void
    {
        $batchA = ExamBatch::create(['name' => 'A', 'is_active' => true]);
        $batchB = ExamBatch::create(['name' => 'B', 'is_active' => false]);

        $this->asAdmin()->put('/admin/exam-batches/'.$batchB->id.'/activate');

        $this->assertFalse($batchA->fresh()->is_active);
        $this->assertTrue($batchB->fresh()->is_active);
    }

    public function test_creating_a_batch_as_active_deactivates_the_previous_one(): void
    {
        $existing = ExamBatch::create(['name' => 'Existing', 'is_active' => true]);

        $this->asAdmin()->post('/admin/exam-batches', [
            'name' => 'New Active',
            'is_active' => '1',
        ]);

        $this->assertFalse($existing->fresh()->is_active);
        $this->assertTrue(ExamBatch::where('name', 'New Active')->first()->is_active);
    }

    // ---------- Enrollments listing ----------

    public function test_enrollments_list_defaults_to_the_active_batch(): void
    {
        $activeBatch = ExamBatch::create(['name' => 'Active Sitting', 'is_active' => true]);
        $oldBatch = ExamBatch::create(['name' => 'Old Sitting', 'is_active' => false]);

        $userInActive = User::factory()->create(['first_name' => 'InActive']);
        $userInOld = User::factory()->create(['first_name' => 'InOld']);

        ExamScore::create(['user_id' => $userInActive->user_id, 'exam_batch_id' => $activeBatch->id, 'score' => 30, 'status' => 'pending']);
        ExamScore::create(['user_id' => $userInOld->user_id, 'exam_batch_id' => $oldBatch->id, 'score' => 25, 'status' => 'pending']);

        $response = $this->asAdmin()->get('/admin/enrollments');

        $response->assertSee('InActive');
        $response->assertDontSee('InOld');
    }

    public function test_enrollments_can_be_filtered_to_a_specific_batch(): void
    {
        $batchA = ExamBatch::create(['name' => 'Sitting A']);
        $batchB = ExamBatch::create(['name' => 'Sitting B']);
        $userA = User::factory()->create(['first_name' => 'PersonA']);
        $userB = User::factory()->create(['first_name' => 'PersonB']);
        ExamScore::create(['user_id' => $userA->user_id, 'exam_batch_id' => $batchA->id, 'score' => 10, 'status' => 'pending']);
        ExamScore::create(['user_id' => $userB->user_id, 'exam_batch_id' => $batchB->id, 'score' => 20, 'status' => 'pending']);

        $response = $this->asAdmin()->get('/admin/enrollments?batch='.$batchA->id);

        $response->assertSee('PersonA');
        $response->assertDontSee('PersonB');
    }

    public function test_all_sittings_view_shows_everything(): void
    {
        $batchA = ExamBatch::create(['name' => 'Sitting A']);
        $batchB = ExamBatch::create(['name' => 'Sitting B']);
        $userA = User::factory()->create(['first_name' => 'PersonA']);
        $userB = User::factory()->create(['first_name' => 'PersonB']);
        ExamScore::create(['user_id' => $userA->user_id, 'exam_batch_id' => $batchA->id, 'score' => 10, 'status' => 'pending']);
        ExamScore::create(['user_id' => $userB->user_id, 'exam_batch_id' => $batchB->id, 'score' => 20, 'status' => 'pending']);

        $response = $this->asAdmin()->get('/admin/enrollments?batch=');

        $response->assertSee('PersonA');
        $response->assertSee('PersonB');
    }

    // ---------- Individual approve/edit ----------

    public function test_approving_a_result_emails_the_candidate(): void
    {
        Mail::fake();
        $user = User::factory()->create();
        $score = ExamScore::create(['user_id' => $user->user_id, 'score' => 35, 'status' => 'pending']);

        $this->asAdmin()->put('/admin/enrollments/'.$score->id.'/status/approved');

        $this->assertEquals('approved', $score->fresh()->status);
        Mail::assertSent(ExamResultApprovedMail::class, fn ($mail) => $mail->hasTo($user->email));
    }

    public function test_setting_pending_does_not_send_an_email(): void
    {
        Mail::fake();
        $user = User::factory()->create();
        $score = ExamScore::create(['user_id' => $user->user_id, 'score' => 35, 'status' => 'approved']);

        $this->asAdmin()->put('/admin/enrollments/'.$score->id.'/status/pending');

        $this->assertEquals('pending', $score->fresh()->status);
        Mail::assertNotSent(ExamResultApprovedMail::class);
    }

    public function test_approve_action_only_affects_the_specific_batch_result(): void
    {
        // Regression test: the old exam_status() matched by user_id alone,
        // which would have approved *every* sitting's result for a user at
        // once now that a user can have more than one.
        Mail::fake();
        $user = User::factory()->create();
        $batchA = ExamBatch::create(['name' => 'A']);
        $batchB = ExamBatch::create(['name' => 'B']);
        $scoreA = ExamScore::create(['user_id' => $user->user_id, 'exam_batch_id' => $batchA->id, 'score' => 10, 'status' => 'pending']);
        $scoreB = ExamScore::create(['user_id' => $user->user_id, 'exam_batch_id' => $batchB->id, 'score' => 20, 'status' => 'pending']);

        $this->asAdmin()->put('/admin/enrollments/'.$scoreA->id.'/status/approved');

        $this->assertEquals('approved', $scoreA->fresh()->status);
        $this->assertEquals('pending', $scoreB->fresh()->status);
    }

    public function test_admin_can_edit_a_score(): void
    {
        $user = User::factory()->create();
        $score = ExamScore::create(['user_id' => $user->user_id, 'score' => 10, 'status' => 'pending']);

        $response = $this->asAdmin()->put('/admin/enrollments/'.$score->id, [
            'score' => 33,
            'status' => 'pending',
            'admin_notes' => 'Rechecked manually',
        ]);

        $response->assertRedirect('/admin/enrollments');
        $this->assertEquals(33, $score->fresh()->score);
        $this->assertEquals('Rechecked manually', $score->fresh()->admin_notes);
    }

    public function test_editing_a_score_to_approved_sends_the_email(): void
    {
        Mail::fake();
        $user = User::factory()->create();
        $score = ExamScore::create(['user_id' => $user->user_id, 'score' => 10, 'status' => 'pending']);

        $this->asAdmin()->put('/admin/enrollments/'.$score->id, [
            'score' => 10,
            'status' => 'approved',
        ]);

        Mail::assertSent(ExamResultApprovedMail::class);
    }

    // ---------- Bulk approve ----------

    public function test_admin_can_bulk_approve_selected_results(): void
    {
        Mail::fake();
        $userA = User::factory()->create();
        $userB = User::factory()->create();
        $scoreA = ExamScore::create(['user_id' => $userA->user_id, 'score' => 10, 'status' => 'pending']);
        $scoreB = ExamScore::create(['user_id' => $userB->user_id, 'score' => 20, 'status' => 'pending']);

        $response = $this->asAdmin()->post('/admin/enrollments/bulk-status', [
            'score_ids' => [$scoreA->id, $scoreB->id],
            'bulk_status' => 'approved',
        ]);

        $response->assertRedirect();
        $this->assertEquals('approved', $scoreA->fresh()->status);
        $this->assertEquals('approved', $scoreB->fresh()->status);
        Mail::assertSent(ExamResultApprovedMail::class, 2);
    }

    // ---------- Export ----------

    public function test_admin_can_export_excel(): void
    {
        User::factory()->create();

        $response = $this->asAdmin()->get('/admin/enrollments/export/excel');

        $response->assertStatus(200);
    }

    public function test_admin_can_export_pdf(): void
    {
        $response = $this->asAdmin()->get('/admin/enrollments/export/pdf');

        $response->assertStatus(200);
    }

    // ---------- Exam-taking flow ----------

    public function test_user_cannot_start_exam_when_no_batch_is_active(): void
    {
        $user = User::factory()->create();

        $response = $this->withSession(['user_id' => $user->user_id])->get('http://exams.step.technology/user/start-exam');

        $response->assertRedirect(route('user.index'));
    }

    public function test_user_can_start_exam_when_a_batch_is_active(): void
    {
        ExamBatch::create(['name' => 'Open Sitting', 'is_active' => true]);
        $user = User::factory()->create();

        $response = $this->withSession(['user_id' => $user->user_id])->get('http://exams.step.technology/user/start-exam');

        $response->assertStatus(200);
    }

    public function test_user_who_already_completed_the_active_sitting_is_redirected(): void
    {
        $batch = ExamBatch::create(['name' => 'Open Sitting', 'is_active' => true]);
        $user = User::factory()->create();
        ExamScore::create(['user_id' => $user->user_id, 'exam_batch_id' => $batch->id, 'score' => 10, 'status' => 'pending']);

        $response = $this->withSession(['user_id' => $user->user_id])->get('http://exams.step.technology/user/start-exam');

        $response->assertRedirect(route('user.exam-done'));
    }

    public function test_user_who_completed_a_past_sitting_can_take_a_newly_opened_one(): void
    {
        $pastBatch = ExamBatch::create(['name' => 'Past Sitting', 'is_active' => false]);
        $user = User::factory()->create();
        ExamScore::create(['user_id' => $user->user_id, 'exam_batch_id' => $pastBatch->id, 'score' => 10, 'status' => 'approved']);

        ExamBatch::create(['name' => 'New Sitting', 'is_active' => true]);

        $response = $this->withSession(['user_id' => $user->user_id])->get('http://exams.step.technology/user/start-exam');

        $response->assertStatus(200);
    }
}
