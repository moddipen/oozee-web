<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Support extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    protected $data = [];

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
        if ($this->data['attach'] != '') {
            return $this->markdown('emails.support')
                ->subject($this->data['subject'])
                ->from($this->data['from'])
                ->attach($this->data['attach'])
                ->with(['message' => $this->data['message'], 'from' => $this->data['from']]);
        } else {
            return $this->markdown('emails.support')
                ->subject($this->data['subject'])
                ->from($this->data['from'])
                ->with(['message' => $this->data['message'], 'from' => $this->data['from']]);
        }
    }
}
