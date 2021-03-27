<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function register(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:255',
            'email'=>'required|max:255',
            'password'=>'required|confirmed',
        ]);

        User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password),
        ]);

        auth()->attempt($request->only('email','password'));

        return redirect('/');
    }

    public function login(Request $request)
    {
        $this->validate($request,[
            'email'=>'required|max:255',
            'password'=>'required',
        ]);
        
        // auth()->attempt([
        //     'email'=> $request->email,
        //     'password'=> $request->password
        // ]);

        if (!auth()->attempt($request->only('email','password'))) {
            return back()->with('login_error','Invalid Credentials');
        }

        return redirect('/');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('posts');
    }
}
