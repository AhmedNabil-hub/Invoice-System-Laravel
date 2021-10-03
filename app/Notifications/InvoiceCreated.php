<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

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
		return ['database'];
	}


	// public function toMail($notifiable)
	// {
	// 	return (new MailMessage)
	// 		->line('The introduction to the notification.')
	// 		->action('Notification Action', url('/'))
	// 		->line('Thank you for using our application!');
	// }


	public function toDatabase($notifiable)
	{
		return [
			'invoice_id' => $this->data['invoice_id'],
			'user_id' => $this->data['user_id'],
			'title' => $this->data['title'],
		];
	}
}
