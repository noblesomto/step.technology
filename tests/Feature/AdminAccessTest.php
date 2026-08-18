<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_away_from_admin_dashboard(): void
    {
        $response = $this->get('/admin/index');

        $response->assertRedirect('/adminlogin');
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->withSession(['admin_id' => $admin->admin_id])->get('/admin/index');

        $response->assertStatus(200);
        $response->assertSee('Dashboard');
    }

    public function test_authenticated_admin_can_access_unified_exam_sections(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->withSession(['admin_id' => $admin->admin_id])->get('/admin/questions');

        $response->assertStatus(200);
    }

    public function test_guest_is_redirected_away_from_member_dashboard(): void
    {
        $response = $this->get('/user/index');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_access_member_dashboard(): void
    {
        $user = User::factory()->create();

        $response = $this->withSession(['user_id' => $user->user_id])->get('/user/index');

        $response->assertStatus(200);
    }

    public function test_payment_confirmation_requires_admin_session(): void
    {
        // Regression test for a bug found in the professional-standard
        // audit: /admin/payment and /admin/confirm-payment were reachable
        // without logging in at all.
        $response = $this->get('/admin/payment');

        $response->assertRedirect('/adminlogin');
    }
}
