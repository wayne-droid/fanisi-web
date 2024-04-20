<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\EnsureAuthenticated;
use Illuminate\Http\Request;

Route::get('/signin', function (Request $request) {
    $request->session()->flush();
    return view('login');
});

Route::get('/login/user',[AuthController::class,'loginUser']);

Route::middleware([EnsureAuthenticated::class])->group(function ()
{
    Route::get('/', function (Request $request){
        return view('users');
    });
    
    Route::get('/new/user', function (Request $request){
        return view('new_user');
    });

    Route::get('/logout',function()
    {
        session()->flush();
        return redirect('/');
    });
});