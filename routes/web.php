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



Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('logout', 'AuthController@logout')->name('logout');
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
    Route::get('master_user', function (){
        return view('master_user');
    });
    Route::get('tambahuser', function (){
        return view('tambah_user');
    });
    Route::get('edituser', function (){
        return view('edit_user');
    });
});

//-------------MASTER GEDUNG-----------------------
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

//--------------MASTER USER--------------------------
Route::get('masteruser', function (){
    return view('user/master_user');
});

Route::get('tambahuser', function (){
    return view('user/tambah_user');
});
Route::get('edituser', function (){
    return view('user/edit_user');
});

//-------------MASTER KOMPONEN----------------------

Route::get('masterkomponen', function (){
    return view('komponen/master_komponen');
});

Route::get('tambah_komponen', function (){
    return view('komponen/tambah_komponen');
});

Route::get('edit_komponen', function (){
    return view('komponen/edit_komponen');
});
