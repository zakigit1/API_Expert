<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/setup', function(){


    $credentials =  [
        'email' => 'admin@gmail.com',
        'password' => 'password'
    ];

    if (!Auth::attempt($credentials)) {

        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password')
        ]);



        if(Auth::attempt($credentials)){
            $user = Auth::user();

            $adminToken = $user->createToken('admin-token',['create', 'read', 'update', 'delete']);
            $updateToken = $user->createToken('update-token',['create', 'read', 'update']);
            $basicToken = $user->createToken('basic-token',['read']);

            return response()->json([
                'admin' => $adminToken->plainTextToken,
                'update' => $updateToken->plainTextToken,
                'basic' => $basicToken->plainTextToken
            ]);

        }
    }


    return 'Hello World';
});