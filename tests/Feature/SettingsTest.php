<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class SettingsTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_access_settings(): void
    {
        $response = $this->get('/admin/settings');

        $response->assertRedirect('/adminlogin');
    }

    public function test_admin_can_view_settings_page(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->withSession(['admin_id' => $admin->admin_id])->get('/admin/settings');

        $response->assertStatus(200);
        $response->assertSee('Site Information');
        $response->assertSee('Change Password');
    }

    public function test_admin_can_update_site_settings(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->withSession(['admin_id' => $admin->admin_id])->put('/admin/settings', [
            'site_name' => 'New Site Name',
            'site_title' => 'New Site Title',
            'site_email' => 'new@example.com',
            'site_phone' => '08011112222',
            'site_address' => 'Test Address',
            'facebook_url' => 'https://facebook.com/test',
            'twitter_url' => '',
            'linkedin_url' => '',
            'payment_account_name' => 'Test Society',
            'payment_account_number' => '1234567890',
            'payment_bank_name' => 'Test Bank',
        ]);

        $response->assertRedirect('/admin/settings');
        $this->assertEquals('New Site Name', Setting::get('site_name'));
        $this->assertEquals('https://facebook.com/test', Setting::get('facebook_url'));
        $this->assertEquals('Test Bank', Setting::get('payment_bank_name'));

        // config('global.*') itself is only re-derived when AppServiceProvider
        // boots (i.e. on the next real request) — not mid-test, since Laravel's
        // test harness reuses one already-booted app instance across
        // $this->get()/put() calls. Verified separately via a live request in
        // manual testing that a fresh request does pick up the new value.
    }

    public function test_settings_update_requires_valid_email(): void
    {
        $admin = Admin::factory()->create();

        $response = $this->withSession(['admin_id' => $admin->admin_id])
            ->from('/admin/settings')
            ->put('/admin/settings', [
                'site_name' => 'New Site Name',
                'site_title' => 'New Site Title',
                'site_email' => 'not-an-email',
                'site_phone' => '08011112222',
            ]);

        $response->assertSessionHasErrors('site_email');
    }

    public function test_admin_can_change_own_password(): void
    {
        $admin = Admin::factory()->create(['password' => 'old-password']);

        $response = $this->withSession(['admin_id' => $admin->admin_id])->post('/admin/settings/password', [
            'current_password' => 'old-password',
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ]);

        $response->assertRedirect('/admin/settings');
        $this->assertTrue(Hash::check('new-password-123', $admin->fresh()->password));
    }

    public function test_password_change_requires_correct_current_password(): void
    {
        $admin = Admin::factory()->create(['password' => 'old-password']);

        $response = $this->withSession(['admin_id' => $admin->admin_id])->post('/admin/settings/password', [
            'current_password' => 'wrong-password',
            'password' => 'new-password-123',
            'password_confirmation' => 'new-password-123',
        ]);

        $response->assertRedirect('/admin/settings');
        $this->assertTrue(Hash::check('old-password', $admin->fresh()->password));
    }

    public function test_password_change_requires_confirmation_to_match(): void
    {
        $admin = Admin::factory()->create(['password' => 'old-password']);

        $response = $this->withSession(['admin_id' => $admin->admin_id])
            ->from('/admin/settings')
            ->post('/admin/settings/password', [
                'current_password' => 'old-password',
                'password' => 'new-password-123',
                'password_confirmation' => 'does-not-match',
            ]);

        $response->assertSessionHasErrors('password');
        $this->assertTrue(Hash::check('old-password', $admin->fresh()->password));
    }

    public function test_member_dashboard_shows_configured_payment_bank_details(): void
    {
        Setting::set('payment_account_name', 'Test Configured Society');
        Setting::set('payment_account_number', '9988776655');
        Setting::set('payment_bank_name', 'Configured Test Bank');
        // Normally re-applied by AppServiceProvider::boot() on the next
        // real request; called explicitly here since this test's app is
        // already booted before the settings above are written.
        Setting::applyToConfig();

        $user = User::factory()->create(['user_type' => 'Young Professional']);

        $response = $this->withSession(['user_id' => $user->user_id])->get('/user/membership');

        $response->assertStatus(200);
        $response->assertSee('Test Configured Society');
        $response->assertSee('9988776655');
        $response->assertSee('Configured Test Bank');
    }
}
