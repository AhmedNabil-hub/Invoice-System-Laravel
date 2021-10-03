<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
	public function authorize()
	{
		if (auth()->check()) {
			return true;
		}

		return false;
	}


	public function rules()
	{
		return [
			'name' => 'required|string|max:255|unique:users,name',
			'email' => 'required|string|email|max:255|unique:users,email',
			'password' => 'required|string|min:8',
			'role' => 'required|exists:roles,id'
		];
	}
}
