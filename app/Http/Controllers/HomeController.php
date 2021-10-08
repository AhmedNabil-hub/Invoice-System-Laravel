<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function changeLang(string $lang)
	{
		App::setLocale($lang);
		Cookie::queue('lang', $lang, 60*24*30);

		return redirect()->back();
	}

	public function index()
	{
		$recent_invoices = Invoice::whereMonth('created_at', date('m'))
			->limit(4)
			->get();
		$users_count = User::count();
		$products_count = Product::count();
		$sections_count = Section::count();
		$invoices_sum = Invoice::sum('total');
		$invoices_count = Invoice::count();
		$paid_invoices_sum = Invoice::where('status', '=', 3)->sum('total');
		$paid_invoices_count = Invoice::where('status', '=', 3)->count();
		$partially_paid_invoices_sum = Invoice::where('status', '=', 2)->sum('total');
		$partially_paid_invoices_count = Invoice::where('status', '=', 2)->count();
		$unpaid_invoices_sum = Invoice::where('status', '=', 1)->sum('total');
		$unpaid_invoices_count = Invoice::where('status', '=', 1)->count();

		return view('index')
			->with('recent_invoices', $recent_invoices)
			->with('users_count', $users_count)
			->with('products_count', $products_count)
			->with('sections_count', $sections_count)
			->with('invoices_sum', $invoices_sum)
			->with('invoices_count', $invoices_count)
			->with('paid_invoices_sum', $paid_invoices_sum)
			->with('paid_invoices_count', $paid_invoices_count)
			->with('partially_paid_invoices_sum', $partially_paid_invoices_sum)
			->with('partially_paid_invoices_count', $partially_paid_invoices_count)
			->with('unpaid_invoices_sum', $unpaid_invoices_sum)
			->with('unpaid_invoices_count', $unpaid_invoices_count);
  }
}
