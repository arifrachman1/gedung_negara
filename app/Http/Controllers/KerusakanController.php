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
        $row = Kerusakan::count(); 
        $id_kerusakan = ++$row;
        $input = Gedung::find($id);
        $session_name = Session::get('name');
        $surveyor = User::where('name', '=', $session_name)->first();
        return view('Kerusakan/formulir_kerusakan_surveyor', compact('input', 'surveyor', 'id_kerusakan'));
    }

    public function inputFormSurveyor(Request $request) {
        $id_gedung = $request->id_gedung;
        $tanggal = $request->tanggal;
        $jam = $request->jam;
        $tanggal_jam = $tanggal." ".$jam;
        // session table kerusakan
        Session::put('kerusakan_id_kerusakan',$request->id_kerusakan);
        Session::put('kerusakan_id_gedung',  $id_gedung);
        Session::put('kerusakan_tanggal_jam', $tanggal_jam);
        // session table kerusakan surveyor
        Session::put('kerusakan_surveyor_id_kerusakan', $request->id_kerusakan);
        Session::put('kerusakan_surveyor_id_user', $request->id_user);

        $id_kerusakan = $request->id_kerusakan;
        $id_user = $request->id_user;

        return redirect()->action('KerusakanController@formIdentifikasiKerusakan', ['id_gedung' => $id_gedung, 'id_kerusakan' => $id_kerusakan, 'id_user' => $id_user]);
    }

    public function formIdentifikasiKerusakan($id_gedung, $id_kerusakan, $id_user) {
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
                  
        return view('Kerusakan/create_formulir_klasifikasi_kerusakan', compact('komponen', 'gedung', 'daerah', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'id_kerusakan', 'id_gedung', 'id_user'));
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
            $hasil_estimasi = $nilai->nilai;
        } else {
            $hasil_estimasi = $nilai->nilai * $bobot->bobot / 100;
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
        Log::info($bobot);

        // menghitung nilai estimasi kerusakan pada sebuah komponen
        if ($sum_hasil == 0) {
            $hasil_persen = 0;
        } else if ($bobot->bobot == null) {
            $hasil_persen = $sum_hasil / 100;
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
        $jumlah = $data['jumlah'];
        Log::info($jumlah);

        // query data bobot komponen
        $bobot = Komponen::select('komponen.bobot as bobot')->where('id', $id_komponen)->first();
        //Log::info($bobot);

        // menghitung nilai estimasi kerusakan pada sebuah komponen
        if ($sum_hasil == 0) {
            $hasil_unit = 0;
        } else if ($bobot->bobot == null) {
            $hasil_unit = $sum_hasil / 100;
        } else {
            $hasil_unit = $sum_hasil * $bobot->bobot / 100;
        }
        
        // mengirim nilai estimasi kerusakan ke view
        return response()->json(['hasil_unit' => $hasil_unit, 'bobot' => $bobot->bobot]);
    }

    public function simpanKerusakanDetail(Request $request) {
        $data = $request->all();
        $input = new KerusakanDetail;
        $input->id_kerusakan = $data['id_kerusakan'];
        $input->id_komponen = $data['id_komponen'];
        $input->id_komponen_opsi = $data['id_komponen_opsi'];
        $input->save();

        return response()->json(['success' => 'Simpan data sukses']);
    }

    public function hapusKerusakan($id) {
        $data = Kerusakan::where('id', $id)->first();
        $data->delete();
        return redirect('master_kerusakan');
    }

    public function postInputKerusakan(Request $request) {
        $input_kerusakan = new Kerusakan;
        $input_kerusakan->id = $request->id_kerusakan;
        $input_kerusakan->id_gedung = Session::get('kerusakan_id_gedung');
        $input_kerusakan->tanggal = Session::get('kerusakan_tanggal_jam');
        $input_kerusakan->detail_json = 0;
    }

}
