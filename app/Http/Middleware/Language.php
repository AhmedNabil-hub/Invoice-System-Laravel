<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class Language
{
	public function handle(Request $request, Closure $next)
	{
		if(Cookie::has('lang')) {
			App::setLocale(Cookie::get('lang'));
		} else {
			App::setLocale(config('app.locale'));
		}

		return $next($request);
	}
}
