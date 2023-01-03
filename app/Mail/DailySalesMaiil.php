<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DailySalesMaiil extends Mailable
{
    use Queueable, SerializesModels;
    public $report;
    public $status;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status, $report)
    {
        $this->report = $report;
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->status == true ? 'Product Sale': 'Sales Cancellation')->from('abeokuta_abk@allrounderventures.com', 'Suppport')->view('mail.newsales-mail')->with([
            'sale' => $this->report['sale'],
            'items' => $this->report['items'],
            'status' => $this->status
        ]);
    }
}
