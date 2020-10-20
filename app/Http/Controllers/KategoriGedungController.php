<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriGedung;

class KategoriGedungController extends Controller
{
    public function index() {
        $kategori = KategoriGedung::get();
        return view('jenisgedung/master_jenisgedung', compact('kategori'));
    }

    public function input() {
        return view('jenisgedung/tambah_master_jenisgedung');
    }

    public function input_post(Request $request) {
        $row = KategoriGedung::count(); 
        $id = ++$row;
        $input = new KategoriGedung;
        $input->id = $id;
        $input->nama = $request->nama_jenis_gedung;
        $input->save();
        return redirect('master_jenisgedung');
    }

    public function edit($id) {
        $edit = KategoriGedung::find($id);
        return view('jenisgedung/edit_master_jenisgedung', compact('edit'));
    }

    public function edit_post(Request $request) {
        $edit_post = KategoriGedung::find($request->id_jenis_gedung);
        $edit_post->nama = $request->nama_jenis_gedung;
        $edit_post->update();
        return redirect('master_jenisgedung');
    }

    public function delete($id) {
        $delete = KategoriGedung::find($id);
        $delete->delete();
        return redirect('master_jenisgedung');
    }
}
