<?php

use App\Mail\EmailTest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group.Make something great!
|
*/

Route::get('/', 'Main@index')->name('index');

Route::get('/login', 'Main@login')->name('login');

Route::post('/login_submit', 'Main@login_submit')->name('login_submit');

//Route::get('/temp', 'Main@temp')->name('temp');

Route::get('/home', 'Main@home')->name('home');

Route::get('/logout', 'Main@logout')->name('logout');

Route::get('/const', function(){

    // constants data acess
    echo config('constants.VERSAO').'<br>';
    echo config('constants.MYSQL_HOST').'<br>';
    echo config('constants.MYSQL_PASS').'<br>';
});

Route::get('/email', function(){
    $name = 'Jorge Mautner';
    Mail::to('jorgefloriano1646@gmail.com')->send(new EmailTest($name));
    echo 'Email enviado!';
});