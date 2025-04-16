<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;


class UserController extends Controller
{


    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ],[
            'email.required' => 'silahkan isi email',
            'password.required' => 'silahkan isi password',
        ]);
    
        $cekLogin = [
            'email' => $request->email,
            'password'=>$request->password,
        ];
    
        if(Auth::attempt($cekLogin)){
            $user = Auth::user();
            if ($user->role == 'admin' || $user->role == 'employee') {
                return redirect()->route('dashboard');
            }
        } else {
            return redirect()->back()->withErrors(['login_failed' => 'Proses login gagal, silakan coba lagi dengan data yang benar!'])->withInput();
        }
    }

    public function loginview()
    {
        return view('login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('logout', 'Anda telah berhasil logout!');
    }

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

    public function edit(Request $request, $id)
    {
        $users = User::findOrFail($id);
        return view('module.user.edit', compact('users'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
            'role' => 'required',
        ],[
            'password.min' => 'password minimal 8 karakter'
        ]);
    
        $user = User::findOrFail($id);
    
        // Cek apakah email sudah terdaftar oleh user lain
        if (User::where('email', $request->email)->exists() && $request->email !== $user->email) {
            return redirect()->back()->with('error', 'Email sudah ada yang pakai');
        }
    
        // Update user data
        $userData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];
    
        // Update password jika ada
        if ($request->filled('password')) {
            $userData['password'] = bcrypt($request->password);
        }
    
        $user->update($userData);
    
        return redirect()->route('user.list')->with('success', 'Berhasil update user');
    }
    
    public function destroy($id)    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.list')->with('success', 'berhasil hapus user');
    }


    
}
