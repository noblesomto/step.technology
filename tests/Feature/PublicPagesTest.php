<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @dataProvider publicPages
     */
    public function test_public_page_loads_successfully(string $uri): void
    {
        $response = $this->get($uri);

        $response->assertStatus(200);
    }

    public static function publicPages(): array
    {
        return [
            'homepage' => ['/'],
            'about' => ['/about'],
            'about-coretep' => ['/about-coretep'],
            'step-support' => ['/step-support'],
            'certifications' => ['/certifications'],
            'journal-publication' => ['/journal-publication'],
            'trainings' => ['/trainings'],
            'contact' => ['/contact'],
            'memberships' => ['/memberships'],
            'blog index' => ['/blog'],
            'events index' => ['/events'],
            'conference' => ['/ICTES2025'],
            'login' => ['/login'],
            'register' => ['/register'],
            'register-undergraduate' => ['/register-undergraduate'],
            'register-corporate-professional' => ['/register-corporate-professional'],
            'register-corporate-organization' => ['/register-corporate-organization'],
            'forgot-password' => ['/forgot-password'],
            'admin login' => ['/adminlogin'],
            'sitemap' => ['/sitemap.xml'],
        ];
    }

    public function test_contact_form_requires_valid_input(): void
    {
        // The reCAPTCHA rule still calls out to Google even when the field
        // is empty, so fake the HTTP layer to keep this test offline.
        Http::fake(['https://www.google.com/recaptcha/*' => Http::response(['success' => false])]);

        $response = $this->from('/contact')->post('/contact', []);

        $response->assertSessionHasErrors(['name', 'subject', 'phone', 'email', 'message']);
    }
}
