<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    protected function asAdmin()
    {
        $admin = Admin::factory()->create();
        return $this->withSession(['admin_id' => $admin->admin_id]);
    }

    public function test_guest_cannot_access_user_management(): void
    {
        $this->get('/admin/users')->assertRedirect('/adminlogin');
        $this->get('/admin/users/create')->assertRedirect('/adminlogin');
    }

    public function test_admin_can_list_users(): void
    {
        User::factory()->count(3)->create();

        $response = $this->asAdmin()->get('/admin/users');

        $response->assertStatus(200);
    }

    public function test_admin_can_search_users(): void
    {
        User::factory()->create(['first_name' => 'Findme', 'last_name' => 'Person']);
        User::factory()->create(['first_name' => 'Other', 'last_name' => 'Person']);

        $response = $this->asAdmin()->get('/admin/users?search=Findme');

        $response->assertStatus(200);
        $response->assertSee('Findme');
        $response->assertDontSee('Other Person');
    }

    public function test_the_literal_create_route_is_not_captured_by_the_dynamic_show_route(): void
    {
        // Regression test: /admin/users/create must resolve to the create
        // form, not be swallowed by GET /admin/users/{user_id} with
        // user_id literally "create".
        $response = $this->asAdmin()->get('/admin/users/create');

        $response->assertStatus(200);
        $response->assertSee('New User');
    }

    public function test_admin_can_create_a_user(): void
    {
        $response = $this->asAdmin()->post('/admin/users', [
            'title' => 'Mr',
            'first_name' => 'Created',
            'last_name' => 'ByAdmin',
            'gender' => 'Male',
            'phone' => '08033334444',
            'email' => 'created-by-admin@example.com',
            'password' => 'password123',
            'user_type' => 'Young Professional',
            'acc_status' => '1',
            'member_status' => 'Pending',
        ]);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', [
            'email' => 'created-by-admin@example.com',
            'acc_status' => '1',
        ]);

        $user = User::where('email', 'created-by-admin@example.com')->first();
        $this->assertTrue(Hash::check('password123', $user->password));
        $this->assertNotEmpty($user->user_id);
    }

    public function test_user_creation_requires_unique_email_and_phone(): void
    {
        $existing = User::factory()->create();

        $response = $this->asAdmin()->from('/admin/users/create')->post('/admin/users', [
            'first_name' => 'Dup',
            'last_name' => 'User',
            'phone' => $existing->phone,
            'email' => $existing->email,
            'password' => 'password123',
            'user_type' => 'Young Professional',
            'acc_status' => '1',
        ]);

        $response->assertSessionHasErrors(['phone', 'email']);
    }

    public function test_admin_can_view_a_user(): void
    {
        $user = User::factory()->create();

        $response = $this->asAdmin()->get('/admin/users/'.$user->user_id);

        $response->assertStatus(200);
        $response->assertSee($user->email);
    }

    public function test_admin_can_update_a_user(): void
    {
        $user = User::factory()->create(['first_name' => 'Before']);

        $response = $this->asAdmin()->put('/admin/users/'.$user->user_id, [
            'title' => 'Dr',
            'first_name' => 'After',
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'user_type' => 'Corporate Professional',
            'acc_status' => '1',
        ]);

        $response->assertRedirect('/admin/users/'.$user->user_id);
        $this->assertEquals('After', $user->fresh()->first_name);
        $this->assertEquals('Corporate Professional', $user->fresh()->user_type);
    }

    public function test_updating_a_user_can_change_the_password(): void
    {
        $user = User::factory()->create(['password' => Hash::make('old-password')]);

        $this->asAdmin()->put('/admin/users/'.$user->user_id, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'user_type' => $user->user_type,
            'acc_status' => '1',
            'password' => 'brand-new-password',
        ]);

        $this->assertTrue(Hash::check('brand-new-password', $user->fresh()->password));
    }

    public function test_updating_a_user_without_password_keeps_the_existing_one(): void
    {
        $user = User::factory()->create(['password' => Hash::make('keep-me')]);

        $this->asAdmin()->put('/admin/users/'.$user->user_id, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email,
            'user_type' => $user->user_type,
            'acc_status' => '1',
        ]);

        $this->assertTrue(Hash::check('keep-me', $user->fresh()->password));
    }

    public function test_email_uniqueness_check_excludes_the_user_being_edited(): void
    {
        $user = User::factory()->create();

        $response = $this->asAdmin()->put('/admin/users/'.$user->user_id, [
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'phone' => $user->phone,
            'email' => $user->email, // unchanged — must not trip the unique rule
            'user_type' => $user->user_type,
            'acc_status' => '1',
        ]);

        $response->assertSessionDoesntHaveErrors();
    }

    public function test_admin_can_verify_and_unverify_a_user(): void
    {
        $user = User::factory()->create(['acc_status' => 0]);

        $this->asAdmin()->put('/admin/users/'.$user->user_id.'/status/1');
        $this->assertEquals(1, (int) $user->fresh()->acc_status);

        $this->asAdmin()->put('/admin/users/'.$user->user_id.'/status/0');
        $this->assertEquals(0, (int) $user->fresh()->acc_status);
    }

    public function test_admin_can_delete_a_user(): void
    {
        $user = User::factory()->create();

        $response = $this->asAdmin()->delete('/admin/users/'.$user->user_id);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseMissing('users', ['user_id' => $user->user_id]);
    }

    public function test_deleting_a_user_also_removes_their_payment_record(): void
    {
        $user = User::factory()->create();
        \App\Models\Payment::create([
            'user_id' => $user->user_id,
            'payment_amount' => '5000',
            'payment_picture' => 'proof.jpg',
            'payment_status' => '0',
        ]);

        $this->asAdmin()->delete('/admin/users/'.$user->user_id);

        $this->assertDatabaseMissing('payments', ['user_id' => $user->user_id]);
    }
}
