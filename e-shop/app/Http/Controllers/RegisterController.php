<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except(['store']);
    }

    public function index()
    {
        return view('authentication.register');
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|max:255',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:5|max:255'
        ];

        $messages = [
            'name.required' => 'Nama tidak boleh kosong',
            'name.min' => 'Nama harus minimal 3 karakter',
            'name.max' => 'Nama harus maksimal 255 karakter',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah digunakan',
            'email.email' => 'Format email salah',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password harus minimal 5 karakter',
            'password.max' => 'Password harus maksimal 255 karakter'
        ];

        $this->validate($request, $rules, $messages);

        User::create([
            'name' => Str::title($request->name),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Registration successully, 🙏 Please login');
    }
}
