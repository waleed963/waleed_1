<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id){
        return view('welcome', ['id' => $id]);
    }
    
    public function create_user($name, $password, $email){

        $new_user = new User;
        $new_user->name = $name;
        $new_user->password = $password;
        $new_user->email = $email;
        $new_user->save();

        return 'created successfully';
    }
}


// I am B