<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

Route::get('/', function () {
    return view('dashboard');
});
//LOGIN
Route::get('login', function(){
    return view('login');
});


// MASTER USER
Route::get('masteruser', function (){
    return view('master_user');
});

Route::get('tambahuser', function (){
    return view('tambah_user');
});

Route::get('edituser', function (){
    return view('edit_user');
});