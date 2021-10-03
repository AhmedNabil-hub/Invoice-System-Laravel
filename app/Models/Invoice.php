<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
	use HasFactory, SoftDeletes, Notifiable;

	protected $fillable = [
		'invoice_number',
		'discount',
		'rate_vat',
		'status',
		'invoice_date',
		'due_date',
		'payment_date',
		'collection_amount',
		'commission_amount',
		'commission_percent',
		'payment_amount',
		'value_vat',
		'total',
		'note',
		'section_id',
		'user_id'
	];

	const STATUS = [
		1 => 'unpaid',
		2 => 'partially paid',
		3 => 'paid'
	];


	public function setProductAttribute($products)
	{
		return $this->attributes['product'] = implode(',', $products);
	}

	public function getProductAttribute($products)
	{
		return $this->attributes['product'] = explode(',', $products);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function section()
	{
		return $this->belongsTo(Section::class);
	}

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}
}
