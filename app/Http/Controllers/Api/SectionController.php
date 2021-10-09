<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use App\Traits\Filter;
use Illuminate\Http\Request;

class SectionController extends Controller
{
	use Filter;

	public function __construct()
	{
		request()->headers->set('Accept', 'application/json');
	}


	public function index()
	{
		$search_filter = [
			'type' => 'section_name',
			'value' => request('search_filter')
		];

		return SectionResource::collection(
			Section::searchFilter($search_filter)
			->get()
		);
	}


	public function store(Request $request)
	{
			//
	}


	public function show($id)
	{
			//
	}


	public function update(Request $request, $id)
	{
			//
	}


	public function destroy($id)
	{
			//
	}
}
