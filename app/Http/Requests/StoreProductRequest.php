<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
			'product_name' => 'required|string|min:3|unique:products,product_name',
			'description' => 'nullable|string|max:200',
			'section_id' => 'required|exists:sections,id'
		];
	}
}
