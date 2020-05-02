<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use phpDocumentor\Reflection\Types\This;

class TransactionSuccess extends Mailable
{
    use Queueable, SerializesModels;
    public $data = false;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        // isi variabel data diatas pakai data yg ditangkap construct
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->from('dev.gafri@gmail.com', 'Gafri Putra')
        ->subject('Tiket Booking Anda')
        ->view('email.transaction-success');
    }
}
