<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailToFriend extends Mailable
{

    use Queueable,
        SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->from($this->data['your_email'], $this->data['your_name'])
//                        ->replyTo($this->data['your_email'], $this->data['your_name'])
//                        ->to($this->data['friend_email'], $this->data['friend_name'])
//                        ->subject(__('Your friend') . ' ' . $this->data['your_name'] . ' ' . __('has shared a link with you'))
//                        ->view('emails.send_to_friend_message')
//                        ->with($this->data);

        return $this->from($this->details['sender'], $this->details['name'])
                        ->replyTo($this->details['sender'], $this->details['name'])
                        ->to('customerservice@httconnect.ca')
                        ->subject('Email from user: '.$this->details['subject'])
                        ->view('customMail.mail')
                        ->with($this->details);
    }

}
