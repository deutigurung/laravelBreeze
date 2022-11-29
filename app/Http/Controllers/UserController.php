<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
//    for single action controller function
//    public function __invoke() {
//        $users = User::all();
//        return view('users',compact('users'));
//    }

    public function index() {
        $users = User::all();
        return view('users.list',compact('users'));
    }

    public function create() {
        return view('users.create');
    }

    public function store(StoreUserRequest $request) {
        $input = $request->all();
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'is_admin' => $input['is_admin'],
            'password' => Hash::make($input['password']),
        ]);
        return redirect()->route('users.index')->with([
            'success' => 'User Added'
        ]);
    }

    public function show(User $user) {

    }

    public function edit(User $user) {
        return view('users.edit',compact('user'));
    }

    public function update(UpdateUserRequest $request,User $user) {
        $input = $request->all();
        $user = User::findOrFail($user->id);
        $user->update([
            'name' => $input['name'],
            'email' => $input['email'],
            'is_admin' => $input['is_admin'],
        ]);
        return redirect()->route('users.index')->with([
            'success' => 'User Updated'
        ]);
    }

    public function destroy(User $user) {

    }
}
