<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class InvoiceCreated extends Notification
{
	use Queueable;

	private $data;

	public function __construct($data)
	{
		$this->data = $data;
	}


	public function via($notifiable)
	{
		return [TelegramChannel::class, 'database', 'mail'];
	}


	public function toMail($notifiable)
	{
		$url = url('/invoices/' . $this->data['invoice_id']);

		return (new MailMessage)
			->subject('Invoice Created')
			->line('New invoice has been added')
			->action('Show invoice', $url)
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
		$url = url('/invoices/' . $this->data['invoice_id']);

		return TelegramMessage::create()
			// Optional recipient user id.
			->to('626602774')

			// Markdown supported.
			->content("Hello there!\nYour invoice has been *Created*")

			// (Optional) Inline Buttons
			->button('View Invoice', $url);
  }
}
