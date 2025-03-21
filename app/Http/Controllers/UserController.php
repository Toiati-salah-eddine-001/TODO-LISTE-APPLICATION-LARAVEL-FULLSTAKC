<?php

namespace App\Http\Controllers;

use App\Http\Requests\validateauth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login_f()
    {
        return view('Auth.logine');
    }
    public function register_f()
    {
        return view('Auth.register');
    }

    public function register(validateauth $request)
    {
        // $request->validate([
        //     'name' =>'string | required',
        //     'email' =>'required | email | unique:users',
        //     'password' => 'required | min:8 ',
        //     'confirm_password'=>'required | min:8 '
        // ]);

        if ($request->password !== $request->confirm_password) {
            return redirect()->route('signUp', ['error' => 'error'])->with('error', 'Passwords do not match');
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' =>  Hash::make($request->password),
        ]);

        return view('Auth.logine');
    }
        public function login(Request $request)
        {
            $request->validate([
                'email' => 'required | email',
                'password' => 'required | min:8',
            ]);

            $credentials = $request->only('email', 'password');
            $user = User::where('email', $request->email)->first();

            if (Auth::attempt($credentials)){
                    $request->session()->regenerate();
                    // session(['user' => Auth::user()]);
                    return redirect()->route('dashboard');

            } else {
                return redirect()->route('login',['error'=>'errore assi mhamed'])->with('error', 'Incorrect email or password');
            }
        }
}
