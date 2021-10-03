<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
		'name' => 'required|unique:roles,name',
		'permission' => 'required',
		'permission.*' => 'exists:permissions,id'
		];
	}
}
