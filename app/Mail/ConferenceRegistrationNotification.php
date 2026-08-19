<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConferenceRegistrationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $registrationData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registrationData)
    {
        $this->registrationData = $registrationData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $action = $this->registrationData['action'] ?? 'submitted';
        $subject = 'ICTS 2025 Registration ' . ucfirst($action);

        $email = $this->subject($subject)
                      ->view('email.conferenceMail');

        // ✅ Attach the payment file if it exists
        if (!empty($this->registrationData['payment'])) {
            $filePath = public_path('uploads/payment/' . $this->registrationData['payment']);
            if (file_exists($filePath)) {
                $email->attach($filePath, [
                    'as' => $this->registrationData['payment'], // filename in email
                    'mime' => mime_content_type($filePath),
                ]);
            }
        }

        return $email;
    }

}
