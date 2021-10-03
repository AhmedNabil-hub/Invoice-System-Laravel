<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
			'name' => 'required|string|max:255|unique:users,name,'.$this->route('user')->id.',id',
			'email' => 'required|string|email|max:255|unique:users,email,'.$this->route('user')->id.',id',
			'role' => 'required|exists:roles,id'
		];
	}
}
