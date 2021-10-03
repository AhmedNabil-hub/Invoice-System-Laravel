<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoicePaymentRequest extends FormRequest
{
  public function authorize()
	{
		if(auth()->check()) {
			return true;
		}

		return false;
	}


	public function rules()
{
		return [
			'remainder' => 'required|numeric',
			'payment_amount' => 'required|numeric',
			'status' => ['required', Rule::in(array_keys(Invoice::STATUS))]
		];
	}
}
