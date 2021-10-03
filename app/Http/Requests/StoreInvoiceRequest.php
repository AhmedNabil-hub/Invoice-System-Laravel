<?php

namespace App\Http\Requests;

use App\Models\Invoice;
use Illuminate\Foundation\Http\FormRequest;

class StoreInvoiceRequest extends FormRequest
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
			'invoice_number' => 'required|max:8|unique:invoices,invoice_number',
			'discount' => 'required|numeric',
			'rate_vat' => 'required|numeric',
			'invoice_date' => 'nullable|date_format:Y-m-d',
			'due_date' => 'nullable|date_format:Y-m-d',
			// 'payment_date' => 'nullable|date_format:Y-m-d',
			'collection_amount' => 'required|numeric|min:0',
			'commission_percent' => 'required|numeric|min:0|max:100',
			'commission_amount' => 'required|numeric|min:0',
			'value_vat' => 'required|numeric',
			'total' => 'required|numeric',
			'note' => 'required|string',
			'section_id' => 'required|exists:sections,id',
			'product' => 'required_with:section',
			'product.*' => 'exists:products,id',
		];
	}
}
