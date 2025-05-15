<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthenticationController extends Controller
{
    public function register(Request $request){
        // dd('hello fron register');
        // dd($request->all());

        try{
            $data = $request->validate([
                'name' => 'required|string|max:30',
                'email' => 'required|unique:users,email|string|max:255',
                'phone' => 'required|string|max:15',
                'password'=>'required|min:8',
                'is_terms_condition_active' => 'nullable'
            ]);

            //handling is_terms_condition_active 'on'

            if(isset($data['is_terms_condition_active']) && $data['is_terms_condition_active'] == 'on'){
                $data['is_terms_condition_active'] = 1;
            }else{
                $data['termsCoditions'] = 0;
            }

            $data['password'] = Hash::make($request->password);
            // dd($data['password']);
            $user = User::create($data);

            //login user
            Auth:: login($user);

            return redirect()->route('home')->with('success','Login successfull.');

        }catch(\Exception $e){
            return redirect()->route('login.register')->with('error',"Something went wrong".$e->getMessage());

        }
    }

    public function login(Request $request){
        // dd($request->all());

        try{
            $data = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8'
            ]);

            if(Auth::attempt($data)){
                $request->session()->regenerate();
                return redirect()->intended('/')->with('success','Login Successfully.');
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
        return redirect()->route('site.home')->with('success','Login Successfully.');

    }
}
