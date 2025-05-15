<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    public function showLogin(){

        return view('auth.login');
    }

    public function showForgetPassword(){
        return view('auth.forget-password');
    }

    public function login(Request $request){
        // dd($request->all());

        try{
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:5'
            ]);

            if(Auth::attempt($data)){
                $request->session()->regenerate();
                return redirect()->intended('/admin')->with('success','Login Successfully.');
            }

            return back()->withErrors([
                'email' => 'The Provided credentials do not match the records.',

            ])->onlyInput('email');

        }catch(\Exception $e){

            return redirect()->back()->with('error','Something Went Wrong'.$e->getMessage());
        }

    }

    public function logout(Request $request){
        Auth::logout();
        // dd($request);
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.page')->with('success','Login Successfully.');

    }
}
