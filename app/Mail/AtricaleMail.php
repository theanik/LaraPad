<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AtricaleMail extends Mailable
{
    use Queueable, SerializesModels;
    public $articale;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($articale)
    {
        $this->articale = $articale;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mailView.articale.new_articale');
    }
}
