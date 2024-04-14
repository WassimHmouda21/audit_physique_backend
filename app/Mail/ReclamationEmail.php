<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReclamationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    protected $description;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $description)
    {
        $this->subject = $subject;
        $this->description = $description;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('New Reclamation')
        ->view('emails.reclamation')
        ->with([
            'subject' => $this->subject,
            'description' => $this->description,
        ]);

    }
    
}
