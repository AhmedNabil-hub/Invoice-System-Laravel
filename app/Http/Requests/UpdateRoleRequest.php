<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
		'name' => 'required|unique:roles,name,'.$this->route('role')->id.',id',
		'permission' => 'required',
		'permission.*' => 'exists:permissions,id'
		];
	}
}
