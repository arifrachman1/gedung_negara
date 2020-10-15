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

Route::get('lokasi_kota/{id}', 'GedungController@getKabKota');

Route::get('lokasi_kec/{id}', 'GedungController@getKecamatan');

Route::get('lokasi_desa/{id}', 'GedungController@getDesaKelurahan');

Route::post('input_master_gedung', 'GedungController@inputPost');

Route::get('detail_master_gedung', 'GedungController@detail');

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

Route::get('masterkomponen','KomponenController@komponen'); // View data buku
Route::get('tambah_komponen','KomponenController@addKomponen'); 
Route::post('tambahAksi','KomponenController@add'); 

Route::get('edit/{id}', 'KomponenController@edit');
Route::post('editAksi','KomponenController@update'); 


Route::get('detail_komponen', function (){
    return view('komponen/detail_komponen');
});

//-------------MASTER KERUSAKAN----------------------

Route::get('master_kerusakan', function (){
    return view('kerusakan/master_kerusakan');
});

Route::get('tambah_master_kerusakan', function (){
    return view('kerusakan/tambah_master_kerusakan');
});

Route::get('view_master_kerusakan', function (){
    return view('kerusakan/view_master_kerusakan');
});

//---------------PENGATURAN------------------

Route::get('pengaturan', function (){
    return view('pengaturan/pengaturan');
});

Route::get('profil', function (){
    return view('pengaturan/profil');
});

//-------------KERUSAKAN GAES--------------

Route::get('kerusakan', function (){
    return view('kerusakan/master_kerusakan');
});

Route::get('coba', function (){
    return view('coba');
});

//----------------SATUAN-------------------

Route::get('mastersatuan','SatuanController@satuan'); 


Route::get('tambahsatuan', function (){
    return view('satuan/tambah_satuan');
});

Route::get('editsatuan', function (){
    return view('satuan/edit_satuan');
});

//---------------ROLE---------------------

Route::get('masterrole', function (){
    return view('role/master_role');
});

Route::get('editrole', function (){
    return view('role/edit_role');
});

Route::get('tambahrole', function (){
    return view('role/tambah_role');
});