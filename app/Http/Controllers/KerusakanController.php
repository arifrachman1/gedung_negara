<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;
use App\Kerusakan;
use App\KerusakanSurveyor;
use App\Gedung;
use App\Komponen;
use App\KomponenOpsi;
use App\User;
use Log;

class KerusakanController extends Controller
{
    public function index() {
        $kerusakan = Kerusakan::select('gedung.nama as nama_gedung', 'gedung_ketegori.nama as jenis_gd', 'gedung.alamat as alamat')
                                ->join('gedung', 'kerusakan.id_gedung', '=', 'gedung.id')
                                ->join('gedung_ketegori', 'gedung.id_gedung_kategori', '=', 'gedung_ketegori.id')
                                ->get();
        return view('Kerusakan/master_kerusakan', compact('kerusakan'));
    }

    public function pilihanGedung() {
        $gedung = Gedung::get();
        return view('Kerusakan/tambah_master_kerusakan', compact('gedung'));
    }

    public function formKerusakanSurveyor($id) {
        $row = Kerusakan::count(); 
        $id_kerusakan = ++$row;
        $input = Gedung::find($id);
        $session_name = Session::get('name');
        $surveyor = User::where('name', '=', $session_name)->first();
        return view('Kerusakan/formulir_kerusakan_surveyor', compact('input', 'surveyor', 'id_kerusakan'));
    }

    public function inputFormSurveyor(Request $request) {
        $tbl_kerusakan = new Kerusakan;
        $tbl_kerusakan->id = $request->id_kerusakan;
        $tbl_kerusakan->id_gedung = $request->id_gedung;
        $id_gedung = $request->id_gedung;

        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $tbl_kerusakan->tanggal = $tanggal." ".$jam;
        //dd($input);
        $tbl_kerusakan->save();

        $tbl_kerusakan_surveyor = new KerusakanSurveyor;
        $tbl_kerusakan_surveyor->id_kerusakan = $request->id_kerusakan;
        $tbl_kerusakan_surveyor->id_user = $request->id_user;
        $tbl_kerusakan_surveyor->save();

        return redirect()->to('create_formulir_klasifikasi_kerusakan/'.$id_gedung);
    }

    public function formIdentifikasiKerusakan($id) {

        $komponen = DB::table('komponen as t1')
            ->select('t2.id as id_komponen',
                     't1.nama as nama_komponen', 
                     't2.nama as sub_komponen', 
                     'satuan.id as id_satuan', 
                     'satuan.nama as nama_satuan')
            ->rightjoin('komponen as t2', 't1.id', '=', 't2.id_parent')
            ->join('satuan', 't2.id_satuan' , '=', 'satuan.id')
            ->orderBy('t1.nama', 'asc')->get();
        $gedung = Gedung::where('id', $id)->first();
        $daerah = Gedung::select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->where('id', $id)->first();
        $provinsi = Provinsi::select('provinsi.nama as nama_provinsi')->where('id_prov', $daerah->kode_provinsi)->first();
        $kab_kota = KabupatenKota::select('kota.nama as nama_kota')->where('id_kota', $daerah->kode_kabupaten)->first();
        $kecamatan = Kecamatan::select('kecamatan.nama as nama_kecamatan')->where('id_kec', $daerah->kode_kecamatan)->first();
        $desa_kelurahan = DesaKelurahan::select('kelurahan.nama as nama_kelurahan')->where('id_kel', $daerah->kode_kelurahan)->first();
                  
        return view('Kerusakan/create_formulir_klasifikasi_kerusakan', compact('komponen', 'gedung', 'daerah', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan'));
    }

    public function getDataKomponen(Request $request) {
        $id_komponen = $request->id_komponen;
        $data_opsi = KomponenOpsi::where('id_komponen', $id_komponen)->get();
        $returnData = view('Kerusakan/create_formulir_klasifikasi_kerusakan', compact('data_opsi'))->render();
        Log::info($returnData);
        return response()->json( ['success' => true, 'html' => $returnData] );
    }

}
