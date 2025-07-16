<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QualifiedApplicantForInterviewNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $formattedDate;

    public function __construct($applicant, $formattedDate)
    {
        $this->applicant = $applicant;
        $this->formattedDate = $formattedDate;
    }

    public function build()
    {
        return $this->subject('Aptitude Test Invitation')
            ->view('admin.pages.qualify-emails.interview_notification', [
                'applicant' => $this->applicant,
                'formattedDate' => $this->formattedDate
            ]);
    }
}
