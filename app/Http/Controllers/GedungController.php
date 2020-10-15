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
            ->select(
                'gedung.nama as nama',
                'gedung_ketegori.nama as nama_kat',
                'gedung.bujur_timur as bujur_timur',
                'gedung.lintang_selatan as lintang_selatan',
                'gedung.legalitas as legalitas',
                'gedung.tipe_milik as tipe_milik',
                'gedung.alas_hak as alas_hak',
                'gedung.luas_lahan as luas_lahan',
                'gedung.jumlah_lantai as jumlah_lantai',
                'gedung.luas as luas_bangunan',
                'gedung.tinggi as tinggi_bangunan',
                'gedung.kelas_tinggi as kelas_tinggi',
                'gedung.kompleks as kompleks',
                'gedung.kepadatan as kepadatan',
                'gedung.permanensi as permanensi',
                'gedung.risk_bakar as risk_bakar',
                'gedung.penangkal as penangkal',
                'gedung.struktur_bawah as struktur_bawah',
                'gedung.struktur_bangunan as struktur_bangunan',
                'gedung.struktur_atap as struktur_atap',
            )->find($id);
        $daerah = Gedung::where('id', $id)->select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->first();
        $provinsi = Provinsi::where('id_prov', $daerah->kode_provinsi)->select('provinsi.nama as nama')->first();
        //dd($provinsi);
        $kab_kota = KabupatenKota::where('id_kota', $daerah->kode_kabupaten)->select('kota.nama as nama')->first();
        $kecamatan = Kecamatan::where('id_kec', $daerah->kode_kecamatan)->select('kecamatan.nama as nama')->first();
        $desa_kelurahan = DesaKelurahan::where('id_kel', $daerah->kode_kelurahan)->select('kelurahan.nama as nama')->first();
        return view('gedung/detail_master_gedung', compact('detail_gedung', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan'));
    }

    public function input(Request $request) {
        $jenis_gedung = KategoriGedung::get();

        return view('gedung/tambah_master_gedung', compact('jenis_gedung'));
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
        $input->save();
        return redirect('master_gedung');
    }

    public function edit($id) {
        $jenis_gedung = KategoriGedung::get();
        $edit = Gedung::join('gedung_ketegori', 'gedung.id_gedung_kategori', '=', 'gedung_ketegori.id')
            ->join('provinsi', 'gedung.kode_provinsi', '=', 'provinsi.id_prov')
            ->join('kota', 'gedung.kode_kabupaten', '=', 'kota.id_kota')
            ->join('kecamatan', 'gedung.kode_kecamatan', '=', 'kecamatan.id_kec')
            ->join('kelurahan', 'gedung.kode_kelurahan', '=', 'kelurahan.id_kel')
            ->select('gedung.*', 'gedung_ketegori.id as id_kat', 'gedung_ketegori.nama as nama_kat',
                'provinsi.id_prov as idprov', 'provinsi.nama as nama_prov', 'kota.id_kota as idkota',
                'kota.nama as nama_kota', 'kecamatan.id_kec as idkec', 'kecamatan.nama as nama_kec', 
                'kelurahan.id_kel as idkel', 'kelurahan.nama as nama_kel')->find($id);
        return view('gedung/edit_master_gedung', compact('edit', 'jenis_gedung'));
    }

    public function edit_post() {

    }

    public function delete($id) {
        $delete = Gedung::find($id);
        $delete->delete();
        return redirect('master_gedung');
    }
}
