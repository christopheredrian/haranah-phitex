<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GenericMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * GenericMail constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    protected $data = [];
    public function build()
    {
        // From address
        $address =  isset($this->data['address']) ? $this->data['address'] :  'christopheredrian@gmail.com';
        $subject = isset($this->data['subject']) ? $this->data['subject'] : 'From Haranah-Phitex testing!';
        $name = isset($this->data['name']) ? $this->data['name'] : 'Chris Espiritu (Haranah developer)';

        return $this->view('emails.generic')
            ->from($address, $name)
            ->cc($address, $name)
            ->bcc($address, $name)
            ->replyTo($address, $name)
            ->subject($subject)
            ->with([ 'data' => $this->data]);
    }
}
