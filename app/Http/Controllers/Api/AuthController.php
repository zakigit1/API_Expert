<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            
            $user = Auth::user();

            $user->tokens()->delete();

            $token = $user->createToken('auth-token', ['create', 'read', 'update', 'delete']);

            return response()->json([
                'token' => $token->plainTextToken
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);




    }

}