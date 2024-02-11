<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class AdminController extends Controller
{
    public function index(){
        $title = 'dashboard';
        return view('index', [ 'title' => $title ]);   
    }

    public function index2(){
        return view('index2');   
    }

    public function login(){
        if(auth()->user()){
            return redirect('/home');
        }

        return view('login');   
    }

    public function child(){
        $title = 'child';
        return view('child', [ 'title' => $title ]);   
    }

    public function profile(){
        $title = 'profile';
        $user = auth()->user();
        return view('profile', [ 'title' => $title, 'user' => $user ]);   
    }

    public function createUser(){
        $title = 'create user';
        return view('profile', [ 'title' => $title ]);   
    }

    public function editUser($user_id){
        $title = 'edit user';
        $user = User::find($user_id);
        return view('profile', [ 'title' => $title, 'user' => $user ]);   
    }

    public function users(){
        $title = 'users';
        $users = User::all();
        return view('users', [ 'title' => $title, 'users' => $users ]);   
    }

    public function delete_user($id){
        $user = User::find($id)->delete();
        return redirect()->back();   
    }

    public function updateProfile(Request $request){
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        $user->name = $request->name; 
        $user->email = $request->email; 

        if($request->filled('password')){
            $user->password = Hash::make($request->password); 
        }
        
        $user->save();

        return redirect()->back();   
    }

    public function createUserPost(Request $request){
        $user = new User;
        $user->name = $request->name; 
        $user->email = $request->email; 
        $user->password = Hash::make($request->password); 
                
        $user->save();

        return redirect()->route('dashboard.users');  
    }

    public function updateUser(Request $request){
        $user_id = $request->user_id;
        $user = User::find($user_id);
        $user->name = $request->name; 
        $user->email = $request->email; 

        if($request->filled('password')){
            $user->password = Hash::make($request->password); 
        }
        
        $user->save();

        return redirect()->route('dashboard.users');   
    }

    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->flush();
        return redirect()->route('dashboard.login');   
    }

    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
}


// I am branch B