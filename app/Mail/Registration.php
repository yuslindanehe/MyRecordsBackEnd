<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Patient;

class Registration extends Mailable
{
    use Queueable, SerializesModels;

    public $patient;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Patient $patient)
    {
        $this->patient = $patient;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Account Registration')
            ->view('emails.registration');
    }
}
