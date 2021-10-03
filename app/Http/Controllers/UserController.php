<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
	function __construct()
	{
		$this->middleware('permission:user-view|user-create|user-edit|user-delete', ['only' => ['index','show']]);
		$this->middleware('permission:user-create', ['only' => ['create','store']]);
		$this->middleware('permission:user-edit', ['only' => ['edit','update']]);
		$this->middleware('permission:user-delete', ['only' => ['destroy']]);
	}

	public function index()
	{
		$users = User::all();

		return view('users.index', compact('users'));
	}


	public function create()
	{

		if(auth()->user()->roles->first()->name != 'super admin') {
			$roles = Role::where('name', '<>', 'super admin')->get();
		} else {
			$roles = Role::all();
		}

		return view('users.create', compact('roles'));
	}


	public function store(StoreUserRequest $request)
	{
		$data = $request->validated();
		$data['password'] = Hash::make($data['password']);

		$user = User::create($data);

		$user->assignRole($data['role']);

		return redirect()->route('users.index')
			->with('message' , 'User created');
	}


	public function show(User $user)
	{
		return view('users.show', compact('user'));
	}


	public function edit(User $user)
	{
		if(auth()->user()->roles->first()->name != 'super admin') {
			$roles = Role::where('name', '<>', 'super admin')->get();
		} else {
			$roles = Role::all();
		}

		return view('users.edit', compact('user', 'roles'));
	}


	public function update(UpdateUserRequest $request, User $user)
	{
		$data = $request->validated();

		$user->update($data);

		DB::table('model_has_roles')
			->where('model_id', $user->id)
			->delete();

		$user->assignRole($data['role']);

		return redirect()->route('users.index')
			->with('message','User updated');

	}


	public function destroy(User $user)
	{
		$user->delete();

		return redirect()->route('users.index')
			->with('message', 'User deleted');
	}
}
