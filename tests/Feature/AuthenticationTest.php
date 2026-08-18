<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_verified_user_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'acc_status' => 1,
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'correct-password',
        ]);

        $response->assertRedirect('/user/index');
        $this->assertEquals($user->user_id, session('user_id'));
    }

    public function test_user_cannot_login_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'acc_status' => 1,
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('/login');
        $this->assertNull(session('user_id'));
    }

    public function test_unverified_user_cannot_login(): void
    {
        $user = User::factory()->create([
            'acc_status' => 0,
            'password' => Hash::make('correct-password'),
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'correct-password',
        ]);

        $response->assertRedirect('/login');
        $this->assertNull(session('user_id'));
    }

    public function test_admin_can_login_with_correct_credentials(): void
    {
        $admin = Admin::factory()->create([
            'username' => 'testadmin',
            'password' => 'super-secret-password',
        ]);

        $response = $this->post('/adminlogin', [
            'username' => 'testadmin',
            'password' => 'super-secret-password',
        ]);

        $response->assertRedirect('/admin/index');
        $this->assertEquals($admin->admin_id, session('admin_id'));
    }

    public function test_admin_cannot_login_with_wrong_password(): void
    {
        Admin::factory()->create([
            'username' => 'testadmin',
            'password' => 'super-secret-password',
        ]);

        $response = $this->post('/adminlogin', [
            'username' => 'testadmin',
            'password' => 'wrong-password',
        ]);

        $response->assertRedirect('adminlogin');
        $this->assertNull(session('admin_id'));
    }

    public function test_admin_password_is_hashed_with_bcrypt_not_md5(): void
    {
        $admin = Admin::factory()->create(['password' => 'plaintext']);

        $this->assertNotEquals(md5('plaintext'), $admin->password);
        $this->assertTrue(Hash::check('plaintext', $admin->password));
        $this->assertStringStartsWith('$2y$', $admin->password);
    }
}
