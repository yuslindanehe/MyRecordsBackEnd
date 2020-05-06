<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Patient;
use Illuminate\Support\Facades\Hash;

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
        $this->patient->code = Hash::make($patient->lastName.$patient->emailAddress);
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
