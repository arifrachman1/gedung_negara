<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;

class GedungController extends Controller
{
    public function index() {
        $gedung = Gedung::get();
        return view('gedung/master_gedung', compact('gedung'));
    }

    public function input(Request $request) {
        $provinsi = Provinsi::where('id_prov', 0)->get();
        return view('gedung/tambah_master_gedung', compact('provinsi'));
    }

    public function kabKota(Request $request) {
        $idProv = $request->id_prov;
        $kabKota = Provinsi::where('id_prov', $idProv)->with('kabupatenKota')->get();
        return response()->json([ 'kabKota' => $kabKota ]);
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
        $input->struktur_bawah = $request->struktur_bawah; 
        $input->struktur_bangunan = $request->struktur_bangunan;
        $input->struktur_atap = $request->struktur_atap;
        $input->kode_provinsi = $request->kode_provinsi;
        $input->kode_kabupaten = $request->kode_kota;
        $input->kode_kecamatan = $request->kode_kecamatan;
        $input->kode_kelurahan = $request->kode_kelurahan;
        $input->save();
        return redirect('master_gedung');
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
