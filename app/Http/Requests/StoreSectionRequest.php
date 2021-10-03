<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
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
			'section_name' => 'required|string|min:3|unique:sections,section_name',
			'description' => 'nullable|string|max:200'
		];
	}
}
