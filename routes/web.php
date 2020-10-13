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
Route::get('master_gedung', 'GedungController@index');

Route::get('tambah_master_gedung', 'GedungController@input');

Route::get('tambah_master_gedung', function (){
    return view('gedung/tambah_master_gedung');
});

Route::get('detail_master_gedung', function (){
    return view('gedung/detail_master_gedung');
});

Route::get('edit_master_gedung', function (){
    return view('gedung/edit_master_gedung');
});

Route::get('hapus_master_gedung/{id}', 'GedungController@delete');

// Route::get('tambah_master_gedung_input', 'GedungController@input_action');

// Route::get('hapus_master_gedung/{id}', 'GedungController@delete');

//--------------MASTER JENIS GEDUNG--------------------------

Route::get('master_jenisgedung', 'KategoriGedungController@index');

Route::get('tambah_master_jenisgedung', 'KategoriGedungController@input');

Route::post('tambah_master_jenisgedung_post', 'KategoriGedungController@input_post');

Route::get('edit_master_jenisgedung/{id}', 'KategoriGedungController@edit');

Route::post('edit_master_jenisgedung_post', 'KategoriGedungController@edit_post');

Route::get('hapus_master_jenisgedung/{id}', 'KategoriGedungController@delete');

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
    return view('komponen/tambah_komponenkw');
});

Route::get('edit_komponen', function (){
    return view('komponen/edit_komponen');
});

//-------------MASTER KERUSAKAN----------------------

Route::get('master_kerusakan', function (){
    return view('kerusakan/master_kerusakan');
});

//---------------PENGATURAN------------------

Route::get('pengaturan', function (){
    return view('pengaturan');
});

//-------------KERUSAKAN GAES--------------
Route::get('kerusakan', function (){
    return view('kerusakan/master_kerusakan');
});

Route::get('coba', function (){
    return view('coba');
});