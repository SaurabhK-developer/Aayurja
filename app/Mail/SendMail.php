<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $imagesendbymailwithstore;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($imagesendbymailwithstore)
    {
        $this->imagesendbymailwithstore = $imagesendbymailwithstore;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('piyush@88gravity.com', 'Ilog Solution')
       ->to('depreet@88gravity.com')
        ->subject('New career lead From Ilog Solution')
        ->view('email.query_leads')
        ->with('data', $this->imagesendbymailwithstore)
        ->attach($this->imagesendbymailwithstore['resume']->getRealPath(),
            [
                    'as' => $this->imagesendbymailwithstore['resume']->getClientOriginalName(),
                'mime' => $this->imagesendbymailwithstore['resume']->getClientMimeType(),
            ]);

    }
}
