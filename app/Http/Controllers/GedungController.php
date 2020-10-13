<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;

class GedungController extends Controller
{
    public function index() {
        return view('', compact(''));
    }

    public function input() {

    }

    public function input_action() {
        $input = new Gedung;
        $input->id_gedung_kategori = 1;
        $input->nama = "SDN Guwo Terus 1";
        $input->bujur_timur = 112.747082;
        $input->lintang_selatan = -7.259171;
        $input->legalitas = "Legal";
        $input->tipe_milik = "Negara";
        $input->alas_hak = "";
        $input->luas_lahan = 2.22;
        $input->jumlah_lantai = 2;
        $input->luas = 1.012;
        $input->tinggi = 4.12;
        $input->kelas_tinggi = "Sedang";
        $input->kompleks = "Khusus";
        $input->kepadatan = "Lokasi Kepadatan Sedang";
        $input->permanensi = "Permanen";
        $input->risk_bakar = "Rendah";
        $input->penangkal = "Pasif";
        $input->struktur_bawah = ""; 
        $input->struktur_bangunan = "";
        $input->struktur_atap = "";
        $input->kode_provinsi = "";
        $input->kode_kabupaten = "";
        $input->kode_kecamatan = "";
        $input->kode_kelurahan = "";
        $input->save();
    }

    public function edit() {

    }

    public function edit_post() {

    }

    public function delete($id) {
        $delete = Gedung::find($id);
        $delete->delete();
    }
}
