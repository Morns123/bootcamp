<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function loginForm(){
        return view('user.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            $user = auth()->user();

            if($user->role == "admin"){
                return redirect('/penerbit');
            }
        }

        return back()->withErrors("Email / Password ndak ada, silahkan coba lagi");
    }

    public function logout(){
        Auth::logout();

        return redirect('/');
    }

    public function index(){
        $user = User::all();
        return view('account/user', compact("user"));
    }

    public function store_admin(Request $request){
        $user = Auth::user();   
        $create = User::create([
            'name' => $request->username,
            'email' => $request->email,
            "role"=> $request->role, 
            'password' => Hash::make($request->password),
            'created_by'=> $user->name,
        ]);

            if(!$create){
                return back()->withErrors(['create' => 'Gagal membuat akun!']);
            }

        return redirect('/user'); //GANTI NANTI
    }

    public function create(){
        return view('account/forms');
    }
}

