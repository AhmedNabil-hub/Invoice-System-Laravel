<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = RouteServiceProvider::HOME;


	public function __construct()
	{
		$this->middleware('guest')->except('logout');
		
		if(!Cookie::has('lang')) {
			Cookie::queue('lang', 'en', 60*24*30);
		}
	}
}
