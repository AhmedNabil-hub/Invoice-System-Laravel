<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
	function __construct()
	{
		$this->middleware('permission:section-view|section-create|section-edit|sectionr-delete', ['only' => ['index','show']]);
		$this->middleware('permission:section-create', ['only' => ['create','store']]);
		$this->middleware('permission:section-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:section-delete', ['only' => ['destroy']]);
	}

	public function index()
	{
		$sections = Section::all();

		return view('sections.index', compact('sections'));
	}


	public function create()
	{
		return view('sections.create');
	}


	public function store(StoreSectionRequest $request)
	{
		$data = $request->validated();

		Section::create(array_merge(
			$data,
			['user_id' => auth()->id()]
		));

		return redirect()->route('sections.index')
			->with('message', 'Section created');
	}


	public function show(Section $section)
	{
		return view('sections.show', compact('section'));
	}


	public function edit(Section $section)
	{
		return view('sections.edit', compact('section'));
	}


	public function update(UpdateSectionRequest $request, Section $section)
	{
		$data = $request->validated();

		$section->update(array_merge(
			$data,
			['user_id' => auth()->id()]
		));

		return redirect()->route('sections.index')
			->with('message', 'Section updated');
	}


	public function destroy(Section $section)
	{
		$section->loadCount('products');
		$section->loadCount('invoices');

    if(($section->products_count != 0) || ($section->invoices_count != 0)) {
      return redirect()->route('sections.index')
        ->with('message', 'This section cannot be deleted because it is related to products or invoices!');
    }

		$section->delete();

		return redirect()->route('sections.index')
			->with('message', 'Section deleted');
	}
}
