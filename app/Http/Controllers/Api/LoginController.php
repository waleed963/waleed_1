<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where(['email' => $request->email])->first();

        if(!$user){
            return response( [
                'status' => 'success',
                'message' => 'user not found',
                'user' => [],
            ] ,404);
        }

        if(!Hash::check($request->password, $user['password'])){
            return response( [
                'status' => 'success',
                'message' => 'Password is Wrong',
                'user' => [],
            ] ,401);
        }

        return response( [
            'status' => 'success',
            'message' => 'user found successfully',
            'user' => $user,
            'token' => $user->createToken('mobile')->plainTextToken
        ]);

    }
}
