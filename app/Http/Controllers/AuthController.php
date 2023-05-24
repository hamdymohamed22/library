<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function sign_up(){
        return view('Auth.register');
    }
    public function sign_in(Request $request){
        // validate
        $user_data =  $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|max:255|unique:users,email",
            "password" => "required|string|min:6|confirmed",
        ]);
        // hash password 
        $user_data['password'] = bcrypt($user_data['password']);
        // store the data 
        $user = User::create($user_data);
        // auto login
        Auth::login($user);
        // redirect 
        return redirect()->route('allBooks');

    }
    public function login_form(){
        return view('Auth.login');
    }
    public function log_in(Request $request){
        // validate
        $user_data =  $request->validate([
            "email" => "required|email|max:255",
            "password" => "required|string|min:6",
        ]);
        // hash & compare & login 
        Auth::attempt(["email"=>$user_data['email'],"password" => $user_data['password']]);
        // redirect 
        return redirect()->route('allBooks');
    }
    public function log_out(){
        Auth::logout();
        return redirect()->route('loginForm');
    }

    public function all_users(){
        dd(User::all());
    }
}
