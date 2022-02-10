<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactForm extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected $contact_data;

    public function __construct(array $contact_data)
    {
        $this->contact_data = $contact_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */


    public function build()
    {
        $mail = $this->markdown('mails.contact');


        return $mail->subject($this->contact_data['subject'])->with($this->contact_data);
    }
}
