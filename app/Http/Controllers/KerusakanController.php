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
use App\KerusakanDetail;
use App\KerusakanSurveyor;
use App\KerusakanKlasifikasi;
use App\Gedung;
use App\Komponen;
use App\KomponenOpsi;
use App\User;
use Log;

class KerusakanController extends Controller
{
    public function index() {
        $kerusakan = Kerusakan::select('kerusakan.id as id','gedung.nama as nama_gedung', 'gedung_ketegori.nama as jenis_gd', 'gedung.alamat as alamat')
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
        $input = Gedung::find($id);
        $session_name = Session::get('name');
        $surveyor = User::where('name', '=', $session_name)->first();
        return view('Kerusakan/formulir_kerusakan_surveyor', compact('input', 'surveyor'));
    }

    public function inputFormSurveyor(Request $request) {
        $id_gedung = $request->id_gedung;
        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $tanggal_jam = $tanggal." ".$jam;
        $id_user = $request->id_user;
        Session::put('opd', $request->opd);
        Session::put('nomor_aset', $request->nomor_aset);
        Session::put('surveyor1', $request->surveyor1);
        Session::put('surveyor2', $request->surveyor2);
        Session::put('surveyor3', $request->surveyor3);
        Session::put('pwopd1', $request->pwopd1);
        Session::put('pwopd2', $request->pwopd2);


        return redirect()->action('KerusakanController@formIdentifikasiKerusakan', ['id_gedung' => $id_gedung, 'id_user' => $id_user]);
    }

    public function formIdentifikasiKerusakan($id_gedung, $id_user) {
        $komponen = DB::table('komponen as t1')
            ->select('t2.id as id_komponen',
                     't1.nama as nama_komponen', 
                     't2.nama as sub_komponen', 
                     'satuan.id as id_satuan', 
                     'satuan.nama as nama_satuan')
            ->rightjoin('komponen as t2', 't1.id', '=', 't2.id_parent')
            ->join('satuan', 't2.id_satuan', '=', 'satuan.id')
            ->orderBy('t1.nama', 'asc')->get();
        $gedung = Gedung::where('id', $id_gedung)->first();
        $daerah = Gedung::select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->where('id', $id_gedung)->first();
        $provinsi = Provinsi::select('provinsi.nama as nama_provinsi')->where('id_prov', $daerah->kode_provinsi)->first();
        $kab_kota = KabupatenKota::select('kota.nama as nama_kota')->where('id_kota', $daerah->kode_kabupaten)->first();
        $kecamatan = Kecamatan::select('kecamatan.nama as nama_kecamatan')->where('id_kec', $daerah->kode_kecamatan)->first();
        $desa_kelurahan = DesaKelurahan::select('kelurahan.nama as nama_kelurahan')->where('id_kel', $daerah->kode_kelurahan)->first();
                  
        return view('Kerusakan/create_formulir_klasifikasi_kerusakan', compact('komponen', 'gedung', 'daerah', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'id_gedung', 'id_user'));
    }

    public function getDataKomponenOpsi(Request $request) {
        $data = $request->all();
        $id_komponen = $data['id_komponen'];
        $dataOpsi = KomponenOpsi::where('id_komponen', $id_komponen)->get();
        return response()->json(['dataOpsi' => $dataOpsi]);
    }

    public function hitungEstimasiKerusakan(Request $request) {
        // request data via ajax
        $data = $request->all();
        $id_komponen = $data['id_komponen'];
        $id_komponen_opsi = $data['id_komponen_opsi'];

        // query data bobot komponen dan nilai opsi
        $bobot = Komponen::select('komponen.bobot as bobot')->where('id', $id_komponen)->first();
        $nilai = KomponenOpsi::select('komponen_opsi.nilai as nilai')->where('id', $id_komponen_opsi)->first();

        // menghitung nilai estimasi kerusakan pada sebuah komponen
        if ($bobot->bobot == null) {
            $hasil_estimasi = $nilai->nilai / 100;
        } else {
            $hasil_estimasi = ($nilai->nilai / 100) * $bobot->bobot / 100;
        }

        // mengirim nilai estimasi kerusakan ke view
        return response()->json(['hasil_estimasi' => $hasil_estimasi]);
    }

    public function hitungKerusakanPersen(Request $request) {
        // request data via ajax
        $data = $request->all();
        $id_komponen = $data['id_komponen'];
        $sum_hasil = $data['sum_hasil'];

        // query data bobot komponen
        $bobot = Komponen::select('komponen.bobot as bobot')->where('id', $id_komponen)->first();

        // menghitung nilai klasifikasi kerusakan pada sebuah komponen
        if ($bobot->bobot == null) {
            $hasil_persen = $sum_hasil;
        } else {
            $hasil_persen = $sum_hasil * $bobot->bobot / 100;
        }
        
        // mengirim nilai estimasi kerusakan ke view
        return response()->json(['hasil_persen' => $hasil_persen, 'bobot' => $bobot->bobot]);
    }

    public function hitungKerusakanUnit(Request $request) {
        // request data via ajax
        $data = $request->all();
        $id_komponen = $data['id_komponen'];
        $sum_hasil = $data['sum_hasil'];

        // query data bobot komponen
        $bobot = Komponen::select('komponen.bobot as bobot')->where('id', $id_komponen)->first();

        // menghitung nilai klasifikasi kerusakan pada sebuah komponen
        if ($bobot->bobot == null) {
            $hasil_unit = $sum_hasil / 100;
        } else {
            $hasil_unit = $sum_hasil * $bobot->bobot / 100;
        }
        
        // mengirim nilai estimasi kerusakan ke view
        return response()->json(['hasil_unit' => $hasil_unit, 'bobot' => $bobot->bobot]);
    }

    public function hapusKerusakan($id) {
        $data = Kerusakan::where('id', $id)->first();
        $data->delete();
        return redirect('master_kerusakan');
    }

    public function postSubmitKerusakan(Request $request) {
        $data = $request->all();
        Log::info($data);

        $id_gedung = $data['id_gedung'];
        $id_komp = $data['id_komp'];
        $tanggal_jam = $data['tanggal_jam'];
        $id_komponen_opsi = $data['id_komp_opsi'];
        $jumlah = $data['jumlah'];
        $tingkat_kerusakan = $data['tingkat_kerusakan'];
        //Log::info($data);
        
        $id_komp_arr = array();
        $jumlah_arr = array();
        $id_komponen_opsi_arr = array();
        $tingkat_kerusakan_arr = array();

        foreach($id_komp as $key => $value){
            $id_komp_arr[$key] = $value;
        }

        foreach($jumlah as $key => $value){
            $jumlah_arr[$key] = $value;
        }

        foreach($id_komponen_opsi as $key => $value){
            $id_komponen_opsi_arr[$key] = $value;
        }

        foreach($tingkat_kerusakan as $key => $value){
            $tingkat_kerusakan_arr[$key] = $value;
        }

        // Create data ke table kerusakan
        $input_tbl_kerusakan = new Kerusakan;
        $input_tbl_kerusakan->id_gedung = $id_gedung;
        $input_tbl_kerusakan->tanggal = $tanggal_jam;
        $input_tbl_kerusakan->opd = Session::get('opd');
        $input_tbl_kerusakan->nomor_aset = Session::get('nomor_aset');
        $input_tbl_kerusakan->petugas_survei1 = Session::get('surveyor1');
        $input_tbl_kerusakan->petugas_survei2 = Session::get('surveyor2'); 
        $input_tbl_kerusakan->petugas_survei3 = Session::get('surveyor3');
        $input_tbl_kerusakan->perwakilan_opd1 = Session::get('pwopd1');
        $input_tbl_kerusakan->perwakilan_opd2 = Session::get('pwopd2');
        $input_tbl_kerusakan->save();

        // Create data ke table kerusakan surveyor
        $input_tbl_surveyor = new KerusakanSurveyor;
        $input_tbl_surveyor->id_kerusakan =  $input_tbl_kerusakan->id;
        $input_tbl_surveyor->id_user = $request->id_user;
        $input_tbl_surveyor->save();

        // Create data ke table kerusakan_detail
        for ($i = 0; $i < count($id_komp_arr); $i++) {
            $input_detail = new KerusakanDetail;
            $input_detail->id_kerusakan = $input_tbl_kerusakan->id;
            $input_detail->id_komponen = $id_komp_arr[$i];
            $input_detail->jumlah = $jumlah[$i];
            $input_detail->id_komponen_opsi = $id_komponen_opsi_arr[$i];
            $input_detail->save();

            $input_klasifikasi = new KerusakanKlasifikasi;
            $input_klasifikasi->id_kerusakan_detail = $input_detail->id;
            $input_klasifikasi->jumlah = $jumlah[$i];
            $input_klasifikasi->tingkat_kerusakan = $tingkat_kerusakan_arr[$i];
            $input_klasifikasi->save();
        }

        return redirect('master_kerusakan');
    }

}
