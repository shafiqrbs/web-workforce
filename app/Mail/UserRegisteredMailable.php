<?php

namespace App\Mail;

use App\Models\Athlete;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredMailable extends Mailable
{

    use SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $athlate = Athlete::where('user_id',$this->user->id)->first();
        return $this->to(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
            ->subject('Athlete "' . $athlate->athlete_name . '" has been registered on "' . config('app.name'))
            ->view('emails.athlete_registered_message')
            ->with(
                [
                    'name' => $athlate->athlete_name,
                    'email' => $this->user->email,
                    'password' => '123456',
                    /*'link' => route('user.profile', $this->user->id),
                    'link_admin' => route('edit.user', ['id' => $this->user->id])*/
                ]
            );
        /*return $this->to(config('mail.recieve_to.address'), config('mail.recieve_to.name'))
                        ->subject('Athlete "' . $this->user->name . '" has been registered on "' . config('app.name'))
                        ->view('emails.athlete_registered_message')
                        ->with(
                                [
                                    'name' => $this->user->name,
                                    'email' => $this->user->email,
                                    'link' => route('user.profile', $this->user->id),
                                    'link_admin' => route('edit.user', ['id' => $this->user->id])
                                ]
        );*/
    }

}
