<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
})->name('login')->middleware('guest');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome')->middleware('auth');


Route::post('/log' , function(){
    $credentials =  request()->only('email','password');
    request()->session()->regenerate();
    if(Auth::attempt($credentials)){
        return redirect('welcome');
    }

    return 'login fatal';

});

Route::get('/logout', function(){
   if(Auth::logout()){
    return redirect('login');
   }
   return redirect('welcome');

});
