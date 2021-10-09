<?php

use App\Http\Controllers\Api\SectionController;
use Illuminate\Support\Facades\Route;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/demo', [SectionController::class, 'index'])
	->name('api.demo');
