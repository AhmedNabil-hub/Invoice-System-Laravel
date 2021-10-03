<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceAdded extends Notification
{
    use Queueable;

		protected $invoice_id;

    public function __construct($invoice_id)
    {
			$this->invoice_id = $invoice_id;
    }


    public function via($notifiable)
    {
			return ['mail'];
    }


    public function toMail($notifiable)
    {
			$url = "http://127.0.0.1:8000/invoices/{$this->invoice_id}/show-details";
			return (new MailMessage)
				->subject('Invoice Added')
				->line('New invoice has been added')
				->action('Show invoice', $url)
				->line('Thank you for using our application!');
    }


    public function toArray($notifiable)
    {
			return [
				//
			];
    }
}
