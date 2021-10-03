<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
	function __construct()
	{
		$this->middleware('permission:role-view|role-create|role-edit|role-delete', ['only' => ['index','show']]);
		$this->middleware('permission:role-create', ['only' => ['create','store']]);
		$this->middleware('permission:role-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:role-delete', ['only' => ['destroy']]);
	}

  public function index(Request $request)
	{
		$roles = Role::all();

		return view('roles.index', compact('roles'));
	}


	public function create()
	{
		$permissions = Permission::all();

		return view('roles.create', compact('permissions'));
	}

	public function store(StoreRoleRequest $request)
	{
		$data = $request->validated();

		$role = Role::create([
			'name' => $data['name']
		]);

		$role->syncPermissions($data['permission']);

		return redirect()->route('roles.index')
			->with('message','Role created');
	}

	public function show(Role $role)
	{
		return view('roles.show', compact('role'));
	}

	public function edit(Role $role)
	{
		$permissions = Permission::all();

		return view('roles.edit',compact('role', 'permissions'));
	}

	public function update(UpdateRoleRequest $request, Role $role)
	{
		$data = $request->validated();

		$role->update(['name' => $data['name']]);

		$role->syncPermissions($data['permission']);

		return redirect()->route('roles.index')
			->with('message','Role updated');
	}

	public function destroy(Role $role)
	{
		$role->delete();

		return redirect()->route('roles.index')
			->with('message','Role deleted');
	}
}
