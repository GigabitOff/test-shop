<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendFormsJobsJobIndexMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data, $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        //$this->subject = $this->makeSubject();
        $this->subject = str_replace('<span>', '', $this->data['subject']);
        $this->subject = str_replace('</span>', '', $this->subject);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->subject($this->subject)
            ->markdown('mails.send-products-ask-question-mail')->with([
                'data' => $this->data,
                'subject' => $this->subject,
            ]);

        if (isset($this->data['files']) && !empty($this->data['files'])) {

            $mail->attach($this->data['files']->path(), [
                'as' => $this->data['files']->getClientOriginalName(),
            ]);
        }
        return $mail;
    }

    protected function makeSubject(): string
    {
        if(!isset($this->data['userId']))
        $this->data['userId']= null;

        return sprintf(
            '#%d# %s',
            $this->data['userId'],
            $this->data['subject']
        );
    }
}
