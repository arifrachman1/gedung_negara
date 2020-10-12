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
    return view('welcome');
});

Route::get('login', function(){
    return view('login');
});

<<<<<<< HEAD
Route::get('dashboard', function () {
=======
Route::get('dashboard', function (){
>>>>>>> 0f7de331eaf0954d8ecc071fd1f7dace7efe8e62
    return view('dashboard');
});