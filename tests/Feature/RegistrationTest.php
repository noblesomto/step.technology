<?php

namespace Tests\Feature;

use App\Mail\RegisterMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_young_professional_can_register(): void
    {
        Mail::fake();

        $response = $this->post('/register-young-professional', [
            'title' => 'Mr',
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'phone' => '08012345678',
            'email' => 'ada@example.com',
            'profession' => 'Engineer',
            'password' => 'password123',
        ]);

        $response->assertRedirect('login');
        $this->assertDatabaseHas('users', [
            'email' => 'ada@example.com',
            'user_type' => 'Young Professional',
            'acc_status' => 0,
        ]);
        Mail::assertSent(RegisterMail::class);
    }

    public function test_registration_requires_unique_email(): void
    {
        Mail::fake();

        User::factory()->create(['email' => 'taken@example.com']);

        $response = $this->from('/register-young-professional')->post('/register-young-professional', [
            'title' => 'Mr',
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'phone' => '08012345679',
            'email' => 'taken@example.com',
            'profession' => 'Engineer',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertDatabaseMissing('users', ['phone' => '08012345679']);
    }

    public function test_registration_requires_unique_phone(): void
    {
        Mail::fake();

        User::factory()->create(['phone' => '08099999999']);

        $response = $this->from('/register-young-professional')->post('/register-young-professional', [
            'title' => 'Mr',
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'phone' => '08099999999',
            'email' => 'unique@example.com',
            'profession' => 'Engineer',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('phone');
    }

    public function test_registration_requires_all_mandatory_fields(): void
    {
        $response = $this->from('/register-young-professional')->post('/register-young-professional', []);

        $response->assertSessionHasErrors(['first_name', 'last_name', 'profession', 'phone', 'email', 'password']);
    }

    public function test_corporate_organization_registration_uses_its_own_field_set(): void
    {
        Mail::fake();

        $response = $this->post('/register-corporate-organization', [
            'company_name' => 'Acme Energy Ltd',
            'phone' => '08055555555',
            'email' => 'acme@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect('login');
        $this->assertDatabaseHas('users', [
            'email' => 'acme@example.com',
            'company_name' => 'Acme Energy Ltd',
            'user_type' => 'Corporate Organisation',
        ]);
    }
}
