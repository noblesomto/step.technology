<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConferenceRegistrationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $registrationData;

    /**
     * Create a new message instance.
     */
    public function __construct($registrationData)
    {
        $this->registrationData = $registrationData;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $email = $this->subject('ICTS 2025 Registration Confirmation')
                      ->view('email.conferenceConfirmationMail');

        // ✅ Attach proof of payment if available
        if (!empty($this->registrationData['payment'])) {
            $filePath = public_path('uploads/payment/' . $this->registrationData['payment']);
            if (file_exists($filePath)) {
                $email->attach($filePath, [
                    'as' => $this->registrationData['payment'], // or "Proof_of_Payment.pdf"
                    'mime' => mime_content_type($filePath),
                ]);
            }
        }

        return $email;
    }
}

