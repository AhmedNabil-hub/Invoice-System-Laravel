<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
	function __construct()
	{
		$this->middleware('permission:product-view|product-create|product-edit|product-delete', ['only' => ['index','show']]);
		$this->middleware('permission:product-create', ['only' => ['create','store']]);
		$this->middleware('permission:product-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:product-delete', ['only' => ['destroy']]);
	}

	public function index()
	{
		$products = Product::all();

		return view('products.index', compact('products'));
	}


	public function create()
	{
		$sections = Section::all();

		return view('products.create', compact('sections'));
	}


	public function store(StoreProductRequest $request)
	{
		$data = $request->validated();

		Product::create(array_merge(
			$data,
			['user_id' => auth()->id()]
		));

		return redirect()->route('products.index')
			->with('message', 'Product created');
	}


	public function show(Product $product)
	{
		//
	}


	public function edit(Product $product)
	{
		$sections = Section::all();

		return view('products.edit', compact('product', 'sections'));
	}


	public function update(UpdateProductRequest $request, Product $product)
	{
		$data = $request->validated();

		$product->update(array_merge(
			$data,
			['user_id' => auth()->id()]
		));

		return redirect()->route('products.index')
			->with('message', 'Product updated');
	}


	public function destroy(Product $product)
	{
		$product->loadCount('invoices');

    if($product->invoices_count != 0) {
      return redirect()->route('sections.index')
        ->with('message', 'This product cannot be deleted because it is related to invoices!');
    }

		$product->delete();

		return redirect()->route('products.index')
			->with('message', 'Product deleted');
	}
}
