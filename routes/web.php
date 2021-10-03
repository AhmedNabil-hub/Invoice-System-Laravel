<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use App\Notifications\InvoiceCreated;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Notification;

Auth::routes();

Route::macro('invoiceResource', function ($uri, $controller) {
    Route::get("{$uri}/trash", [$controller, 'getTrashedInvoices'])
			->name("{$uri}.trash");

		Route::post("{$uri}/{invoice}/restore", [$controller, 'restore'])
			->withTrashed()
			->name("{$uri}.restore");

		Route::delete("{$uri}/{invoice}/permanent-delete", [$controller, 'permanentDelete'])
			->withTrashed()
			->name("{$uri}.permanent-delete");

		Route::get("{$uri}/{invoice}/show-details", [$controller, 'showDetails'])
			->name("{$uri}.show-details");

		Route::get("{$uri}/{invoice}/edit-payment", [$controller, 'editPayment'])
			->name("{$uri}.edit-payment");

		Route::put("{$uri}/{invoice}/update-payment", [$controller, 'updatePayment'])
			->name("{$uri}.update-payment");

		Route::get("{$uri}/export/", [$controller, 'export'])
			->name("{$uri}.export");

    Route::resource($uri, $controller);
});

Route::middleware(['auth'])->group(function () {
	Route::get('/', [HomeController::class, 'index'])->name('home');
	Route::redirect('/home', '/');
	Route::invoiceResource('invoices', InvoiceController::class);
	Route::resource('sections', SectionController::class);
	Route::resource('products', ProductController::class);
	Route::resource('roles', RoleController::class);
	Route::resource('users', UserController::class);

	Route::get('/section/{id}', [InvoiceController::class, 'getSelectedSectionProducts']);

	Route::get('/mark-read', function () {
		auth()->user()->unreadNotifications->markAsRead();

		return redirect()->back();
	})->name('mark-read');
});

Route::get('/test/{locale}', function ($locale) {
	if (! in_array($locale, ['en', 'ar'])) {
		abort(400);
	}

	App::setLocale($locale);

	return view('test');
});



