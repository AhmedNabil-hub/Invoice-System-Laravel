<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  use HasFactory;

	protected $fillable = [
		'section_name',
		'description',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function invoices()
	{
		return $this->hasMany(Invoice::class);
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
