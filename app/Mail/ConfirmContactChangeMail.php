<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmContactChangeMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     */
    public $applicant;
    public $oldContact;
    public $newContact;
    public $otp;

    public function __construct($applicant, $oldContact, $newContact, $otp)
    {
        $this->applicant = $applicant;
        $this->oldContact = $oldContact;
        $this->newContact = $newContact;
        $this->otp = $otp;
    }
    public function build()
    {
        return $this->subject('Confirm Phone Number Change')
            ->view('portal.emails.confirm_contact_change')
            ->with([
                'url' => route('confirm.contact.change', [
                    'applicant_id' => $this->applicant->id,
                    'new_contact' => $this->newContact,
                    'token' => encrypt($this->newContact),
                ]),
                'otp' => $this->otp,
            ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
