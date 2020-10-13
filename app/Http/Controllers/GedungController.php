<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;

class GedungController extends Controller
{
    public function index() {
        $gedung = Gedung::get();
        return view('gedung/master_gedung', compact('gedung'));
    }

    public function input() {
        return view('gedung/tambah_master_gedung');
    }

    public function input_post(Request $request) {
        $input = new Gedung;
        $input->id_gedung_kategori = $request->kategori;
        $input->nama = $request->nama;
        $input->bujur_timur = $request->bujur;
        $input->lintang_selatan = $request->lintang;
        $input->legalitas = $request->legalitas;
        $input->tipe_milik = $request->tipe_milik;
        $input->alas_hak = $request->alas_hak;
        $input->luas_lahan = $request->luas_lahan;
        $input->jumlah_lantai = $request->jumlah_lantai;
        $input->luas = $request->luas_bangunan;
        $input->tinggi = $request->tinggi_bangunan;
        $input->kelas_tinggi = $request->klas_tinggi;
        $input->kompleks = $request->kompleks;
        $input->kepadatan = $request->kepadatan;
        $input->permanensi = $request->permanensi;
        $input->risk_bakar = $request->risk_bakar;
        $input->penangkal = $request->penangkal;
        $input->struktur_bawah = ''; 
        $input->struktur_bangunan = '';
        $input->struktur_atap = '';
        $input->kode_provinsi = '';
        $input->kode_kabupaten = '';
        $input->kode_kecamatan = '';
        $input->kode_kelurahan = '';
        $input->save();
    }

    public function edit() {

    }

    public function edit_post() {

    }

    public function delete($id) {
        $delete = Gedung::find($id);
        $delete->delete();
        return redirect('master_gedung');
    }
}
