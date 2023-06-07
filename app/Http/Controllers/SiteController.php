<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function home() {
        return inertia('welcome');
    }

    public function loginForm() {
        return inertia('auth/login');
    }

    public function login(Request $request){
        $request->validate([
            'email'         =>'required|string',
            'password'      =>'required|string'
        ]);

        $login = auth()->attempt($request->all());

        if($login)
            return redirect('/dashboard')->with('message', "Welcome to Task Tracker, $request->email");

        else
            return back()->withErrors(['authentication'=>'Invalid email and/or password']);
    }

    public function registerForm() {
        return inertia('auth/register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'          => ['required', 'string'],
            'username'      =>['required', 'string'],
            'email'         => ['required', 'string', 'email', 'unique:users'],
            'password'      => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        auth()->attempt($request->all());

        User::create([
            'name'          => $request->name,
            'username'      =>$request->username,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
        ]);

        // session()->flash('message', 'Account created successfully');
        return redirect('/login')->with('message','Account created successfully');
    }


    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
