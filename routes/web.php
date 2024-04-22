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

// Middleware example
Route::get('/edit/{id_user}', 'Main@edit')->middleware('checksession')->name('main_edit');

// Route::middleware('checksession')->group(function(){
//     Route::get('/home', 'Main@home')->name('home');
//     Route::get('/logout', 'Main@logout')->name('logout');
// });

Route::get('/final/{hash}', 'Main@final')->name('main_final');

// File upload
Route::post('/upload', 'Main@upload')->name('main_upload');

Route::get('/file_list', 'Main@file_list')->name('file_list');

Route::get('/download/{file}', 'Main@download')->name('download');