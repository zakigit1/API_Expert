<?php

use App\Http\Controllers\Api\V1 as ApiV1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

route::get('/tests', function(){
    return 'Hello World';
});

route::group([
        'prefix' => 'v1',
        // 'middleware' => 'auth:sanctum'
    ], function(){
    route::apiResource('customers', ApiV1\CustomerController::class);
    Route::apiResource('invoices', ApiV1\InvoiceController::class);
});
