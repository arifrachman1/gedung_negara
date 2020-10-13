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

Route::get('dashboard', function (){
    return view('dashboard');
});

Route::get('master_gedung', function (){
    return view('gedung/master_gedung');
});
Route::get('tambah_master_gedung', function (){
    return view('gedung/tambah_master_gedung');
});
Route::get('detail_master_gedung', function (){
    return view('gedung/detail_master_gedung');
});
Route::get('edit_master_gedung', function (){
    return view('gedung/edit_master_gedung');
});