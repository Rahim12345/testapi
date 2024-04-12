<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'status' => 'error'
            ]);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            $token = $user->createToken('Login')->accessToken;
            return response()->json([
                'token' => $token,
                'message' => 'Login successfully'
            ]);
        }

        return response()->json([
            'token' => null,
            'message' => 'unauthorized'
        ], 401);
    }

    public function users()
    {
        $users = User::all();
        return response()->json($users, 200);
    }
}
