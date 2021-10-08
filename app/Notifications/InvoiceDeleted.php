<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class InvoiceDeleted extends Notification
{
	use Queueable;

	private $data;
	private $url;

	public function __construct($data)
	{
		$this->data = $data;
		$this->url = url('/invoices/trash');
	}


	public function via($notifiable)
	{
		return [TelegramChannel::class, 'database', 'mail'];
	}


	public function toMail($notifiable)
	{
		return (new MailMessage)
			->subject('Invoice Deleted')
			->line("Invoice with id {$this->data['invoice_id']} has been temporary deleted")
			->action('Show invoice', $this->url)
			->line('Thank you for using our application!');
	}


	public function toDatabase($notifiable)
	{
		return [
			'invoice_id' => $this->data['invoice_id'],
			'user_id' => $this->data['user_id'],
			'title' => $this->data['title'],
		];
	}

	public function toTelegram($notifiable)
  {
		return TelegramMessage::create()
			->to('626602774')

			->content("Hello there!\nInvoice with id {$this->data['invoice_id']} has been *Deleted*")

			->button('View Invoice', $this->url);
  }
}
