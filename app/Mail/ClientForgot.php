<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientForgot extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->data['user_type']==0) {
            $url = url('class/changepassword')."/".$this->data['id'];
        }else
        {
            $url = url('student/changepassword')."/".$this->data['id'];
        }
        //dd($url);
        $address = env("MAIL_FROM_ADDRESS");
        $subject = 'Oktat Change Password Link';
        $name = env("MAIL_FROM_NAME");
        
        return $this->view('mail.client_forgot')
                    ->from($address, $name)
                    ->subject($subject)
                    ->with([ 'url' => $url ]);
    }
}
