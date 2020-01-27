<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// Authentication
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(){
      return view('back.auth.login');
    }
    
    public function loginPost(Request $request){
      if (Auth::attempt(['mail' => $request->email , 'password' => $request->password])) {
        toastr()->success('Welcome Back!'. Auth::user()->name);
        return redirect()->route('dashboard');
      }
      else{
        return redirect()->route('login')->withErrors('Email or Password is incorrect');
      }
      
    }
    
    public function logout(Request $request){
        Auth::logout();
        toastr()->success('Logged Out Successfully!');
        return redirect()->route('login');
        
    }
    
  
    
    
    
}
