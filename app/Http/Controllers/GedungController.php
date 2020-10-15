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
        $detail_gedung = Gedung::join('gedung_ketegori', 'gedung.id_gedung_kategori', '=', 'gedung_ketegori.id')
            ->join('provinsi', 'gedung.kode_provinsi', '=', 'provinsi.id_prov')
            ->join('kota', 'gedung.kode_kabupaten', '=', 'kota.id_kota')
            ->join('kecamatan', 'gedung.kode_kecamatan', '=', 'kecamatan.id_kec')
            ->join('kelurahan', 'gedung.kode_kelurahan', '=', 'kelurahan.id_kel')
            ->select('gedung.*', 'gedung_ketegori.nama as nama_kat', 'provinsi.nama as nama_prov', 
                'kota.nama as nama_kota', 'kecamatan.nama as nama_kec', 'kelurahan.nama as nama_kel')->find($id);
        return view('gedung/detail_master_gedung', compact('detail_gedung'));
    }

    public function input(Request $request) {
        $provinsi = Provinsi::orderBy('nama', 'asc')->get();
        $jenis_gedung = KategoriGedung::get();

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
        $input->nama = $request->nama_gd;
        $input->id_gedung_kategori = $request->kategori_gd;
        $input->bujur_timur = $request->bt;
        $input->lintang_selatan = $request->ls;
        $input->legalitas = $request->legalitas;
        $input->tipe_milik = $request->tipe_milik;
        $input->alas_hak = $request->alas_hak;
        $input->luas_lahan = $request->luas_lahan;
        $input->jumlah_lantai = $request->jumlah_lantai;
        $input->luas = $request->luas_bangunan;
        $input->tinggi = $request->tinggi_bangunan;
        $input->kelas_tinggi = $request->kls_tinggi;
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

    public function edit($id) {
        $edit = Gedung::join('gedung_ketegori', 'gedung.id_gedung_kategori', '=', 'gedung_ketegori.id')
            ->join('provinsi', 'gedung.kode_provinsi', '=', 'provinsi.id_prov')
            ->join('kota', 'gedung.kode_kabupaten', '=', 'kota.id_kota')
            ->join('kecamatan', 'gedung.kode_kecamatan', '=', 'kecamatan.id_kec')
            ->join('kelurahan', 'gedung.kode_kelurahan', '=', 'kelurahan.id_kel')
            ->select('gedung.*', 'gedung_ketegori.id as id_kat', 'gedung_ketegori.nama as nama_kat',
                'provinsi.id_prov as idprov', 'provinsi.nama as nama_prov', 'kota.id_kota as idkota',
                'kota.nama as nama_kota', 'kecamatan.id_kec as idkec', 'kecamatan.nama as nama_kec', 
                'kelurahan.id_kel as idkel', 'kelurahan.nama as nama_kel')->find($id);
        return view('gedung/edit_master_gedung', compact('edit'));
    }

    public function edit_post() {

    }

    public function delete($id) {
        $delete = Gedung::find($id);
        $delete->delete();
        return redirect('master_gedung');
    }
}
