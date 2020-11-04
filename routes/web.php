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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



Route::get('/', 'AuthController@showFormLogin')->name('login');
Route::get('login', 'AuthController@showFormLogin')->name('login');
Route::post('login', 'AuthController@login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');    
    Route::get('logout', 'AuthController@logout')->name('logout');

    // Route::get('dashboard', function (){
    //     $role = Role::find(1);
    //     $user = auth()->user();
    //     // $role->revokePermissionTo('edit post');//delet permision
    //     $user->can('edit post');
    //     // $role->givePermissionTo('edit post','delete post','add post','view post');//manambah permissin\
    //     // $user->syncPermissions(['add post','delete post']);
// });
    //---------------ROLE---------------------
    Route::get('masterrole', 'RoleController@index');
   

    Route::get('/role/detail/{id}', 'RoleController@detail')->name('role.detail');
    Route::post('/role/give-permission/{id}', 'RoleController@givePermission')->name('role.givePermission');
    Route::get('/role/update/{id}', 'RoleController@update')->name('role.update');
        
    Route::get('tambahrole', 'RoleController@addRole');
    Route::post('aksiAdd', 'RoleController@Add');
    Route::post('destroy','RoleController@delete')->name('hapusrole'); 
    
    //----------------SATUAN-------------------
    Route::get('mastersatuan','SatuanController@satuan'); 
    Route::get('tambahsatuan','SatuanController@inputSatuan');
    Route::post('inputsatuanpost','SatuanController@inputSatuanPost');

    Route::get('editsatuan/{id}','SatuanController@edit');
    Route::post('postSatuan/{id}','SatuanController@editSatuanPost');

    Route::post('deleteSatuan','SatuanController@delete')->name('hapussatuan'); 

    //-------------MASTER KOMPONEN----------------------

    Route::get('masterkomponen','KomponenController@komponen'); 
    Route::get('tambah_komponen','KomponenController@addKomponen'); 
    Route::post('tambah_komponen_aksi','KomponenController@Add'); 

    Route::get('edit/{id}', 'KomponenController@edit');
    Route::post('editAksi/{id}','KomponenController@update'); 
    Route::post('delete','KomponenController@delete')->name('hapuskomponen'); 
    Route::get('detail/{id}','KomponenController@detail'); 
    
    //-------------MASTER GEDUNG-----------------------
    Route::get('master_gedung', 'GedungController@index');
    Route::get('tambah_master_gedung', 'GedungController@input');
    Route::get('lokasi_kota/{id}', 'GedungController@getKabKota');
    Route::get('lokasi_kec/{id}', 'GedungController@getKecamatan');
    Route::get('lokasi_desa/{id}', 'GedungController@getDesaKelurahan');
    Route::post('input_master_gedung', 'GedungController@inputPost');
    Route::get('detail_master_gedung/{id}', 'GedungController@detail');
    Route::get('edit_master_gedung/{id}', 'GedungController@edit');
    Route::post('edit_master_gedung_post/{id}', 'GedungController@edit_post');
    Route::get('export_pdf_master_gedung/', 'GedungController@exportPDF');
    Route::get('tambah_excel_master_gedung', function (){
        return view ('gedung/tambah_excel_master_gedung');
    });

    Route::get('hapus_master_gedung/{id}', 'GedungController@delete');
    Route::get('export_excel_master_gedung', 'GedungController@exportExcel');
    Route::post('import_excel_master_gedung', 'GedungController@importExcel');
    // Route::get('tambah_master_gedung_input', 'GedungController@input_action');
    // Route::get('hapus_master_gedung/{id}', 'GedungController@delete');

        
    //--------------MASTER JENIS GEDUNG--------------------------

    Route::get('master_jenisgedung', 'KategoriGedungController@index');
    Route::get('tambah_master_jenisgedung', 'KategoriGedungController@input');
    Route::post('tambah_master_jenisgedung_post', 'KategoriGedungController@input_post');
    Route::get('edit_master_jenisgedung/{id}', 'KategoriGedungController@edit');
    Route::post('edit_master_jenisgedung_post', 'KategoriGedungController@edit_post');
    Route::get('hapus_master_jenisgedung/{id}', 'KategoriGedungController@delete');
    
  //---------------PENGATURAN------------------

    Route::get('pengaturan', 'PengaturanController@pengaturan');

    Route::get('profil', 'PengaturanController@profil');

    Route::post('update_pwd/{id}', 'PengaturanController@updatePwd');
        
    //--------------MASTER USER--------------------------
    Route::get('masteruser', 'UsersController@index');
    Route::get('tambahuser', 'UsersController@inputUser');
    Route::post('inputuserpost', 'UsersController@inputUserPost');
    Route::get('edituser/{id}', 'UsersController@editUser');
    Route::post('edituserpost/{id}', 'UsersController@editUserPost');
    Route::get('hapususer/{id}', 'UsersController@deleteUser');

    //--------------MASTER USER--------------------------
    Route::get('masteruser', 'UsersController@index');
    Route::get('tambahuser', 'UsersController@inputUser');
    Route::post('inputuserpost', 'UsersController@inputUserPost');
    Route::get('edituser/{id}', 'UsersController@editUser');
    Route::post('edituserpost/{id}', 'UsersController@editUserPost');
    Route::get('hapususer/{id}', 'UsersController@deleteUser');


});

//-------------MASTER KERUSAKAN----------------------

Route::get('master_kerusakan', 'KerusakanController@index');
Route::get('tambah_master_kerusakan', 'KerusakanController@pilihanGedung');
Route::get('formulir_kerusakan_surveyor/{id}', 'KerusakanController@formKerusakanSurveyor');
Route::get('create_formulir_klasifikasi_kerusakan/{id_gedung}/{id_kerusakan}', 'KerusakanController@formIdentifikasiKerusakan');
Route::post('hitung_estimasi_kerusakan', 'KerusakanController@hitungEstimasiKerusakan')->name('hitung_estimasi_kerusakan');
Route::post('hitung_kerusakan_unit', 'KerusakanController@hitungKerusakanUnit')->name('hitung_kerusakan_unit');
Route::post('hitung_kerusakan_persen', 'KerusakanController@hitungKerusakanPersen')->name('hitung_kerusakan_persen');
Route::post('post_formulir_surveyor', 'KerusakanController@inputFormSurveyor');
Route::post('get_data_komponen_opsi/', 'KerusakanController@getDataKomponenOpsi')->name('get_data_komponen_opsi');
Route::get('hapus_kerusakan/{id}', 'KerusakanController@hapusKerusakan');

Route::get('view_kerusakan', function (){
    return view('kerusakan/view_kerusakan');
});
Route::get('edit_formulir_penilaian_kerusakan', function (){
    return view('kerusakan/edit_formulir_penilaian_kerusakan');
});
Route::get('edit_view_master_kerusakan', function (){
    return view('kerusakan/edit_view_master_kerusakan');
});
Route::get('import_master_kerusakan', function (){
    return view('kerusakan/import_master_kerusakan');
});
Route::get('kerusakan', function (){
    return view('kerusakan/master_kerusakan');
});



Route::get('sample_excel', function (){
    $inputFileName = '../storage/excel_template/temp_gedung.xlsx';

    /** Load $inputFileName to a Spreadsheet object **/
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();
    $data = [
        ["Nama" => "SDN Ampelgading 1", "BT" => 121.2, "LS" => 12.33, "Legalitas" => "Legal", "Tipe_Milik" => "Negara", "Alas_Hak" => "Letter C", "Luas_Lahan" => 123.12, "Jml_Lantai" => 2, "Luas_BG" => 112.314, "Tinggi_BG" => 11, "Klas_Tggi" => "Sedang", "Kompleks" => "Sedang", "Kepadatan" => "Lokasi Kepadatan Sedang", "Permanensi" => "Permanen", "Risk_Bakar" => "Rendah", "Penangkal" => "Pasif", "Stktur_Bwh" => "A", "Stktur_BG" => "A", "Stktur_Atp" => "A"],
        ["Nama" => "SDN Ranuyoso 1", "BT" => 121.2, "LS" => 12.33, "Legalitas" => "Legal", "Tipe_Milik" => "Negara", "Alas_Hak" => "Letter C", "Luas_Lahan" => 123.12, "Jml_Lantai" => 2, "Luas_BG" => 112.314, "Tinggi_BG" => 11, "Klas_Tggi" => "Sedang", "Kompleks" => "Sedang", "Kepadatan" => "Lokasi Kepadatan Sedang", "Permanensi" => "Permanen", "Risk_Bakar" => "Rendah", "Penangkal" => "Pasif", "Stktur_Bwh" => "A", "Stktur_BG" => "A", "Stktur_Atp" => "A"],
        ["Nama" => "SDN Tempeh 1", "BT" => 121.2, "LS" => 12.33, "Legalitas" => "Legal", "Tipe_Milik" => "Negara", "Alas_Hak" => "Letter C", "Luas_Lahan" => 123.12, "Jml_Lantai" => 2, "Luas_BG" => 112.314, "Tinggi_BG" => 11, "Klas_Tggi" => "Sedang", "Kompleks" => "Sedang", "Kepadatan" => "Lokasi Kepadatan Sedang", "Permanensi" => "Permanen", "Risk_Bakar" => "Rendah", "Penangkal" => "Pasif", "Stktur_Bwh" => "A", "Stktur_BG" => "A", "Stktur_Atp" => "A"],
    ];
    $i = 1;
    foreach($data as $d){
        $i++;
        $sheet->setCellValue('A'.$i, ($i-1));
        $sheet->setCellValue('B'.$i, $d['Nama']);
        $sheet->setCellValue('C'.$i, $d['BT']);
        $sheet->setCellValue('D'.$i, $d['LS']);
        $sheet->setCellValue('E'.$i, $d['Legalitas']);
        $sheet->setCellValue('F'.$i, $d['Tipe_Milik']);
        $sheet->setCellValue('G'.$i, $d['Alas_Hak']);
        $sheet->setCellValue('H'.$i, $d['Luas_Lahan']);
        $sheet->setCellValue('I'.$i, $d['Jml_Lantai']);
        $sheet->setCellValue('J'.$i, $d['Luas_BG']);
        $sheet->setCellValue('K'.$i, $d['Tinggi_BG']);
        $sheet->setCellValue('L'.$i, $d['Klas_Tggi']);
        $sheet->setCellValue('M'.$i, $d['Kompleks']);
        $sheet->setCellValue('N'.$i, $d['Kepadatan']);
        $sheet->setCellValue('O'.$i, $d['Permanensi']);
        $sheet->setCellValue('P'.$i, $d['Risk_Bakar']);
        $sheet->setCellValue('Q'.$i, $d['Penangkal']);
        $sheet->setCellValue('R'.$i, $d['Stktur_Bwh']);
        $sheet->setCellValue('S'.$i, $d['Stktur_BG']);
        $sheet->setCellValue('T'.$i, $d['Stktur_Atp']);
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save('sample_excel.xlsx');
    return redirect('sample_excel.xlsx');
});