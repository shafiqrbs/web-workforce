<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailSend extends Mailable
{
    use Queueable, SerializesModels;
    public $details;


    public function __construct($details)
    {
        $this->details = $details;
    }

    public function build()
    {
        if (isset($this->details['mailpage']) && $this->details['mailpage'] == 'AthleteRegister') {
            return $this->subject($this->details['title'])
                ->view('emails.athlete_registered_message');
        }

        if (isset($this->details['mailpage']) && $this->details['mailpage'] == 'AthleteRegisterByAdmin') {
            return $this->subject($this->details['title'])
                ->view('emails.athlete_registered_admin_message');
        }

        if (isset($this->details['mailpage']) && $this->details['mailpage'] == 'AthleteRegisterApproval') {
            return $this->subject($this->details['title'])
                ->view('emails.athlete_registered_approval_message');
        }

        if (isset($this->details['mailpage']) && $this->details['mailpage'] == 'ContactForm') {
            return $this->subject($this->details['data']->subject)
                ->view('emails.contact_form_message');
        }
    }
}
