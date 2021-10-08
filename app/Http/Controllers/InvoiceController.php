<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Support\Arr;
use App\Exports\InvoiceExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\InvoiceCreated;
use App\Notifications\InvoiceDeleted;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use Illuminate\Support\Facades\Notification;
use App\Http\Requests\UpdateInvoicePaymentRequest;

class InvoiceController extends Controller
{
	function __construct()
	{
		$this->middleware('permission:invoice-view|invoice-create|invoice-edit|invoice-delete', ['only' => ['index','show']]);
		$this->middleware('permission:invoice-create', ['only' => ['create','store']]);
		$this->middleware('permission:invoice-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:invoice-delete', ['only' => ['destroy']]);
	}

	public function index()
	{
		$invoices = Invoice::all();

		return view('invoices.index', compact('invoices'));
	}


	public function create()
	{
		$products = Product::all();
		$sections = Section::all();

		return view('invoices.create', compact('products', 'sections'));
	}


	public function store(StoreInvoiceRequest $request)
	{
		$data = array_merge(
			$request->validated(),
			['user_id' => auth()->id()]
		);

		$invoice = Invoice::create(Arr::except(
			$data,
			['product']
		));

		$invoice->products()->attach($data['product']);

		DB::table('invoices_details')->insert([
			'payment_amount' => 0,
			'remainder' => $data['total'],
			'status' => 1,
			'invoice_id' => $invoice->id
		]);

		$notificationData = [
			'invoice_id' => $invoice->id,
			'title' => 'New invoice created',
			'user_id' => $invoice->user->id,
		];


		Notification::send(
			User::role('superadmin')->get(),
			new InvoiceCreated($notificationData)
		);

		// $notificationData = [
		// 	'invoice_id' => $invoice->id,
		// 	'title' => 'New invoice created',
		// 	'user_id' => $invoice->user->id,
		// 	'created_at' => $invoice->created_at
		// ];

		// event(new InvoiceCreated($notificationData));

		return redirect()->route('invoices.index')
			->with('message', 'Invoice created');
	}


	public function show(Invoice $invoice)
	{
		return view('invoices.show', compact('invoice'));
	}

	public function showDetails(Invoice $invoice)
	{
		$invoiceDetails = DB::select('select * from invoices_details where invoice_id = ?', [$invoice->id]);

		return view('invoices.showDetails', compact('invoice', 'invoiceDetails'));
	}


	public function edit(Invoice $invoice)
	{
		$products = Product::all();
		$sections = Section::all();

		return view('invoices.edit', compact('invoice', 'products', 'sections'));
	}


	public function update(UpdateInvoiceRequest $request, Invoice $invoice)
	{
		$data = array_merge(
			$request->validated(),
			['user_id' => auth()->id()]
		);

		$invoice->update(Arr::except(
			$data,
			['product']
		));

		$invoice->products()->sync($data['product']);

		return redirect()->route('invoices.index')
			->with('message', 'Invoice updated');
	}


	public function destroy(Invoice $invoice)
	{
		$invoice->delete();

		$notificationData = [
			'invoice_id' => $invoice->id,
			'title' => "Invoice with number {$invoice->invoice_number} deleted",
			'user_id' => $invoice->user->id,
		];

		Notification::send(
			User::role('superadmin')->get(),
			new InvoiceDeleted($notificationData)
		);

		return redirect()->route('invoices.index');
	}

	public function permanentDelete(Invoice $invoice)
	{
		$invoice->products()->detach($invoice->products);

		$invoice->forceDelete();

		return redirect()->route('invoices.trash');
	}

	public function restore(Invoice $invoice)
	{
		$invoice->restore();

		return redirect()->route('invoices.trash');
	}

	public function getTrashedInvoices()
	{
		$trashedInvoices = Invoice::onlyTrashed()->get();

		return view('invoices.trash', compact('trashedInvoices'));
	}

	public function getSelectedSectionProducts($id)
	{
		$selectedSectionProducts = DB::table('products')
			->where('section_id', $id)
			->pluck('product_name', 'id');

		return json_encode($selectedSectionProducts);
	}

	public function editPayment(Invoice $invoice)
	{
		return view('invoices.editPayment', compact('invoice'));
	}


	public function updatePayment(UpdateInvoicePaymentRequest $request, Invoice $invoice)
	{
		$data = $request->validated();

		$invoice->update([
			'status' => $data['status']
		]);

		DB::table('invoices_details')->insert([
			'payment_amount' => $data['payment_amount'],
			'remainder' => $data['remainder'],
			'status' => $data['status'],
			'invoice_id' => $invoice->id
		]);

		return redirect()->route('invoices.show', $invoice->id)
			->with('message', 'Invoice updated');
	}

	public function export()
	{
		return Excel::download(new InvoiceExport, 'invoices.xlsx');
	}
}
