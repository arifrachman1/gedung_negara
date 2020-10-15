<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;
use App\KategoriGedung;
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;
use Log;

class GedungController extends Controller
{
    public function index() {
        $gedung = Gedung::get();
        return view('gedung/master_gedung', compact('gedung'));
    }

    public function detail($id) {
        $detail_gedung = Gedung::find($id);
        return view('gedung/detail_master_gedung', compact('detail_gedung'));
    }

    public function input(Request $request) {
        $provinsi = Provinsi::get();
        $jenis_gedung = KategoriGedung::with('Gedung')->get();
        //dd($jenis_gedung);
        return view('gedung/tambah_master_gedung', compact('provinsi', 'jenis_gedung'));
    }

    public function getKabKota($id) {
        $kabKota = Provinsi::where('id_prov', $id)->with('kabupatenKota')->get();
        Log::info($kabKota);
        return response()->json([ 'kabKota' => $kabKota ]);
    }

    public function getKecamatan($id) {
        $kecamatan = KabupatenKota::where('id_kota', $id)->with('Kecamatan')->get();
        //Log::info($kecamatan);
        return response()->json([ 'Kecamatan' => $kecamatan ]);
    }

    public function getDesaKelurahan($id) {
        $desaKelurahan = Kecamatan::where('id_kec', $id)->with('DesaKelurahan')->get();
        //Log::info($desaKelurahan);
        return response()->json([ 'desaKelurahan' => $desaKelurahan ]);
    }

    public function inputPost(Request $request) {
        $input = new Gedung;
        $input->id_gedung_kategori = $request->kategori_gd;
        $input->nama = $request->nama_gd;
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
