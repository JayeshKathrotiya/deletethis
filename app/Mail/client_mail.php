<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class client_mail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $address = env("MAIL_FROM_ADDRESS");
        $subject = 'FAQ For Client';
        $name = env("MAIL_FROM_NAME");
        
        return $this->view('mail.client_mail')
                    ->from($address, $name)
                    ->subject($subject);
                    // ->with([ 'test_message' => $this->data['message'] ]);
    }
}
