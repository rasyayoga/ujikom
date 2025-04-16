<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('module.user.index', compact('users'));
    }
    public function create()
    {
        return view('module.user.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Email sudah ada yang make');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('user.list')->with('success', 'sukses membuat user baru');
    }
    public function destroy($id)    {
        //
    }
}
