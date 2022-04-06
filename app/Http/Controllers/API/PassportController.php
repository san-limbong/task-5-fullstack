<?php

namespace App\Http\Controllers\API;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;
use App\Http\Controllers\Controller;

class PassportController extends Controller
{
    public function login(Request $request){
        $login = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (! Auth::attempt($login)){
            $msg = 'Invalid credential';
            return response()->json($msg);
        }

        $accessToken = Auth::user()->createToken('accessToken')->accessToken;
        return response()->json([
            'user' => Auth::user(),
            'access_token' => $accessToken
        ]);
    }

    public function users(){
        $users = User::all();
        return response()->json($users);
    }
}
