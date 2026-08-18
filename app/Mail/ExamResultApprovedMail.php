<?php

namespace App\Mail;

use App\Models\ExamScore;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExamResultApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user, public ExamScore $score)
    {
    }

    public function build()
    {
        return $this->subject('Your STEP Exam Result Has Been Approved')
            ->view('email.examResultApprovedMail');
    }
}
