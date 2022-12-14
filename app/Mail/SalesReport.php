<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SalesReport extends Mailable
{
    use Queueable, SerializesModels;

    public $reports;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reports)
    {
        $this->reports = $reports;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('abeokuta_abk@allrounderventures.com', 'Suppport')
        ->view('mail.sales-mail');
    }
}
