<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BulkMail extends Mailable
{
    use Queueable, SerializesModels;

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
        if(empty($this->details['attachmentFile'])){
            return $this->replyTo($this->details['ReplyToMail'], $this->details['ReplyToName'])->subject(''.$this->details['subject'].'')->markdown('emails.bulk_mail');
        }else{
            $this->replyTo($this->details['ReplyToMail'], $this->details['ReplyToName'])->subject(''.$this->details['subject'].'')->markdown('emails.bulk_mail');
            foreach ($this->details['attachmentFile'] as $file){
                $this->attach($file->getRealPath(), ['as' => $file->getClientOriginalName()]);
            }
            return $this;
        }
    }
}
