<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        // From address
        $address =  isset($this->data['address']) ? $this->data['address'] :  'christopheredrian@gmail.com';
        $subject = isset($this->data['subject']) ? $this->data['subject'] : 'From Haranah-Phitex testing!';
        $name = isset($this->data['name']) ? $this->data['name'] : 'Chris Espiritu (Haranah developer)';

        return $this->view('emails.test')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([ 'data' => $this->data]);
    }
}
