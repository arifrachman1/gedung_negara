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
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PDF;
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
        Session::put('tanggal', $tanggal);
        Session::put('jam', $jam);


        return redirect()->action('KerusakanController@formIdentifikasiKerusakan', ['id_gedung' => $id_gedung, 'id_user' => $id_user]);
    }

    public function formIdentifikasiKerusakan($id_gedung, $id_user) {   
        $id_parents = DB::table('komponen as prnt')
            ->select('prnt.id_parent as id')
            ->join('komponen as chld', 'chld.id', '=', 'prnt.id_parent')
            ->groupBy('prnt.id_parent')
            ->get()->pluck('id')->toArray();
        $komponens = DB::table('komponen')
            ->select('id', 'nama')
            ->whereIn('id', $id_parents)
            ->get();
        foreach ($komponens as $parent) {
            $subKomponen = DB::table('komponen as kom')
                ->select('kom.id', 'kom.id_parent', 'kom.nama', 'kom.bobot', 'sat.id as id_satuan', 'sat.nama as satuan')
                ->join('satuan as sat', 'sat.id', '=', 'kom.id_satuan')
                ->where('id_parent', $parent->id)
                ->get();
            $parent->numberOfSub = count($subKomponen);
            $parent->subKomponen = $subKomponen;
        }
                    
        $gedung = Gedung::where('id', $id_gedung)->first();
        $daerah = Gedung::select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->where('id', $id_gedung)->first();
        $provinsi = Provinsi::select('provinsi.nama as nama_provinsi')->where('id_prov', $daerah->kode_provinsi)->first();
        $kab_kota = KabupatenKota::select('kota.nama as nama_kota')->where('id_kota', $daerah->kode_kabupaten)->first();
        $kecamatan = Kecamatan::select('kecamatan.nama as nama_kecamatan')->where('id_kec', $daerah->kode_kecamatan)->first();
        $desa_kelurahan = DesaKelurahan::select('kelurahan.nama as nama_kelurahan')->where('id_kel', $daerah->kode_kelurahan)->first();
                  
        return view('Kerusakan/create_formulir_klasifikasi_kerusakan', compact('komponens', 'gedung', 'daerah', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'id_gedung', 'id_user'));
    }

    public function submitKlasifikasiKerusakan(Request $request){
        $_klasifikasiKerusakan = [0.20, 0.40, 0.60, 0.80, 1.00];
        $timeUpload = strtotime("now");
        
        //File Bukti
        foreach ($request->gambar_bukti as $index => $gambar_bukti) {
            $buktiExt       = $gambar_bukti->getClientOriginalExtension();
            $buktiFileName  = "bukti_".$timeUpload.'_'.$index.'.'.$buktiExt;
            $gambar_bukti->move('bukti', $buktiFileName);
        }

        //Files Denah
        foreach ($request->sketsa_denah as $index => $denah) {  
            $denahExt    = $denah->getClientOriginalExtension();
            $denahFileName   =   "denah_".$timeUpload.'_'.$index.'.'.$denahExt;
            $denah->move('denah', $denahFileName);
        }

        // Create data ke table kerusakan
        $newKerusakan = new Kerusakan;
        $newKerusakan->id_gedung         = $request->id_gedung;
        $newKerusakan->tanggal           = date('Y-m-d H:i:s');
        $newKerusakan->opd               = Session::get('opd');
        $newKerusakan->nomor_aset        = Session::get('nomor_aset');
        $newKerusakan->petugas_survei1   = Session::get('surveyor1');
        $newKerusakan->petugas_survei2   = Session::get('surveyor2'); 
        $newKerusakan->petugas_survei3   = Session::get('surveyor3');
        $newKerusakan->perwakilan_opd1   = Session::get('pwopd1');
        $newKerusakan->perwakilan_opd2   = Session::get('pwopd2');
        $newKerusakan->created_at        = date('Y-m-d H:i:s');
        $newKerusakan->save();
        
        // Create data ke table kerusakan surveyor
        $newKerusakanSurveyor = new KerusakanSurveyor;
        $newKerusakanSurveyor->id_kerusakan  = $newKerusakan->id;
        $newKerusakanSurveyor->id_user       = $request->id_user;
        $newKerusakanSurveyor->save();

        $satuans = $request->get('satuans');
        foreach ($satuans as $index => $satuan) {
            $newKerusakanDetail = new KerusakanDetail;
            $newKerusakanDetail->id_kerusakan       = $newKerusakan->id;
            $newKerusakanDetail->id_komponen        = $request->get('komponens')[$index];
            $newKerusakanDetail->tingkat_kerusakan  = $request->get('tk_value')[$index];

            if($satuan == 1){
                $newKerusakanDetail->id_komponen_opsi   =  $request->get('val_estimasi_'.$index)[0];
                $newKerusakanDetail->save();
            }else if($satuan == 2){
                $newKerusakanDetail->save();
                $inputPersentases = $request->get('val_persentase_'.$index);
                foreach ($inputPersentases as $indexInput => $input) {
                    $input_klasifikasi = new KerusakanKlasifikasi;
                    $input_klasifikasi->id_kerusakan_detail     = $newKerusakanDetail->id;
                    $input_klasifikasi->nilai_input_klasifikasi = ($input) ? $input : 0;
                    $input_klasifikasi->klasifikasi             = $_klasifikasiKerusakan[$indexInput];
                    $input_klasifikasi->save();
                }
            }else{
                $newKerusakanDetail->jumlah             = $request->get('val_jumlah_unit_'.$index)[0];
                $newKerusakanDetail->save();
                $inputUnits = $request->get('val_unit_'.$index);
                foreach ($inputUnits as $indexInput => $input) {
                    $input_klasifikasi = new KerusakanKlasifikasi;
                    $input_klasifikasi->id_kerusakan_detail     = $newKerusakanDetail->id;
                    $input_klasifikasi->nilai_input_klasifikasi = ($input) ? $input : 0;
                    $input_klasifikasi->klasifikasi             = $_klasifikasiKerusakan[$indexInput];
                    $input_klasifikasi->save();
                }
            }

        }

        return redirect()
            ->action('KerusakanController@viewKerusakan', [$newKerusakan->id])
            ->with(['success' => 'Kerusakan berhasil ditambahkan.']);
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

    // public function hapusKerusakan($id) {
    //     $data = Kerusakan::where('id', $id)->first();
    //     $data->delete();
    //     return redirect('master_kerusakan');
    // }
    function delete(Request $request) {
        $delete = Kerusakan::find($request->id);
        $delete->delete();
        return redirect('master_kerusakan');
    }

    public function mapStatusTingkatKerusakan($tingkat_kerusakan) {
        if ($tingkat_kerusakan <= 0.3) {
            $status = "Tingkat Kerusakan Rendah";
        } else if ($tingkat_kerusakan > 0.3 && $tingkat_kerusakan <= 0.45) {
            $status = "Tingkat Kerusakan Sedang";
        } else {
            $status = "Tingkat Kerusakan Tinggi";
        }
        return $status;
    }

    public function viewKerusakan($id_kerusakan) {
        $id_parents = KerusakanDetail::select('id_parent as id')
            ->join('komponen', 'komponen.id', '=', 'kerusakan_detail.id_komponen')
            ->where('id_kerusakan', $id_kerusakan)
            ->distinct('komponen.id_parent')->pluck('id')->toArray();
        $komponens = DB::table('komponen')
            ->select('id', 'nama')
            ->whereIn('id', $id_parents)
            ->get();
        foreach ($komponens as $komponen) {
            $subKomponen = DB::table('kerusakan_detail as kd')
                ->select(
                    'kom.id as id_komponen','kom.id_satuan', 'kom.nama', 'kom.bobot',
                    'kd.tingkat_kerusakan', 'kd.jumlah', 'kd.id as id_kerusakan_detail', 
                    'kd.id_komponen_opsi as id_komponen_opsi',
                    'sat.id as id_satuan', 'sat.nama as satuan'
                )
                ->where('id_kerusakan', $id_kerusakan)
                ->where('id_parent', $komponen->id)
                ->join('komponen as kom', 'kom.id', '=', 'kd.id_komponen')
                ->join('satuan as sat', 'sat.id', '=', 'kom.id_satuan')
                ->get()->toArray();

                $komponen->numberOfSub = count($subKomponen);
                $komponen->subKomponen = $subKomponen;

                $sumTingkatKerusakan = 0;
                foreach($komponen->subKomponen as $subKomponen){
                    if ($subKomponen->id_satuan == 2) {
                        $subKomponen->klasifikasi = DB::table('kerusakan_klasifikasi')->where('id_kerusakan_detail', $subKomponen->id_kerusakan_detail)->get()->toArray();
                    }
                    else{
                        $subKomponen->klasifikasi = DB::table('kerusakan_klasifikasi')->where('id_kerusakan_detail', $subKomponen->id_kerusakan_detail)->get()->toArray();
                    }

                    $sumTingkatKerusakan += $subKomponen->tingkat_kerusakan;
                }
                $komponen->sumTingkatKerusakan = $sumTingkatKerusakan;
                $komponen->sumTingkatKerusakanStatus = $this->mapStatusTingkatKerusakan($sumTingkatKerusakan);
        }
        //dd($komponens);

        $kerusakan = Kerusakan::select('kerusakan.opd as opd', 'gedung.nama as nama_gedung', 'gedung.luas as luas', 'gedung.jumlah_lantai as jml_lantai', 'kerusakan.nomor_aset as nomor_aset', 'kerusakan.tanggal as tanggal', 'kerusakan.petugas_survei1 as petugas_survei1', 'kerusakan.petugas_survei2 as petugas_survei2', 'kerusakan.petugas_survei3 as petugas_survei3', 'kerusakan.perwakilan_opd1 as perwakilan_opd1', 'kerusakan.perwakilan_opd2 as perwakilan_opd2')->join('gedung', 'kerusakan.id_gedung', '=', 'gedung.id')->where('kerusakan.id', $id_kerusakan)->first();

        
        $gedung = Gedung::select('gedung.id as id_gedung')->join('kerusakan', 'gedung.id', '=', 'kerusakan.id_gedung')->where('kerusakan.id', $id_kerusakan)->first();
        $daerah = Gedung::select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->where('id', $gedung->id_gedung)->first();
        $provinsi = Provinsi::select('provinsi.nama as nama_provinsi')->where('id_prov', $daerah->kode_provinsi)->first();
        $kab_kota = KabupatenKota::select('kota.nama as nama_kota')->where('id_kota', $daerah->kode_kabupaten)->first();
        $kecamatan = Kecamatan::select('kecamatan.nama as nama_kecamatan')->where('id_kec', $daerah->kode_kecamatan)->first();
        $desa_kelurahan = DesaKelurahan::select('kelurahan.nama as nama_kelurahan')->where('id_kel', $daerah->kode_kelurahan)->first();

        return view('Kerusakan/view_kerusakan', compact('kerusakan', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'komponens'));
    }

    public function postSubmitKerusakan(Request $request) {
        $data = $request->all();
        //Log::info($data);

        $id_gedung = $data['id_gedung'];
        $id_komp = $data['id_komp'];
        $tanggal_jam = $data['tanggal_jam'];
        $id_komponen_opsi = $data['id_komp_opsi'];
        $jumlah = $data['jumlah'];
        $tingkat_kerusakan = $data['tingkat_kerusakan'];
        $input_nilai_klsf = $data['input_nilai_klsf'];
        $klasifikasi = $data['klasifikasi'];
        Log::info($data);

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
        for ($i = 0; $i < count($id_komp); $i++) {
            $input_detail = new KerusakanDetail;
            $input_detail->id_kerusakan = $input_tbl_kerusakan->id;
            $input_detail->id_komponen = $id_komp[$i];
            $input_detail->id_komponen_opsi = $id_komponen_opsi[$i];
            $input_detail->jumlah = $jumlah[$i];
            $input_detail->tingkat_kerusakan = $tingkat_kerusakan[$i];
            $input_detail->save();

            for ($j = 0; $j < count($klasifikasi); $j++) {
                for ($k = 0; $k < count($klasifikasi[$j]); $k++) {
                    $input_klasifikasi = new KerusakanKlasifikasi;
                    $input_klasifikasi->id_kerusakan_detail = $input_detail->id;
                    $input_klasifikasi->nilai_input_klasifikasi = $input_nilai_klsf[$j][$k];
                    $input_klasifikasi->klasifikasi = $klasifikasi[$j][$k];
                    $input_klasifikasi->save();
                }
            }

        }
        
        return response()->json(['message', 'Input sukses']);
    }

    public function editFormKerusakan($id) {
        $kerusakan = Kerusakan::select('kerusakan.id as id_kerusakan',
                                       'kerusakan.opd as opd', 
                                       'kerusakan.nomor_aset as nomor_aset',
                                       'kerusakan.petugas_survei1 as petugas_survei1',
                                       'kerusakan.petugas_survei2 as petugas_survei2',
                                       'kerusakan.petugas_survei3 as petugas_survei3',
                                       'kerusakan.perwakilan_opd1 as perwakilan_opd1',
                                       'kerusakan.perwakilan_opd2 as perwakilan_opd2',
                                       'kerusakan.tanggal as tanggal',
                                       'gedung.id as id_gedung',
                                       'gedung.nama as nama_gedung',
                                       'gedung.alamat as alamat',
                                       'gedung.luas as luas', 
                                       'gedung.jumlah_lantai as jml_lantai')
                                ->join('gedung', 'kerusakan.id_gedung', '=', 'gedung.id')
                                ->where('kerusakan.id', $id)
                                ->first();
        
        return view('kerusakan/edit_formulir_penilaian_kerusakan', compact('kerusakan'));
    }

    public function postEditFormSurveyor(Request $request) {
        $id_kerusakan = $request->id_kerusakan;
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


        return redirect()->action('KerusakanController@formEditIdentifikasiKerusakan', ['id_kerusakan' => $id_kerusakan]);
    }

    public function formEditIdentifikasiKerusakan($id_kerusakan) {
        $kerusakan = Kerusakan::select('kerusakan.id as id_kerusakan',
                                       'kerusakan.opd as opd', 
                                       'kerusakan.nomor_aset as nomor_aset',
                                       'kerusakan.petugas_survei1 as petugas_survei1',
                                       'kerusakan.petugas_survei2 as petugas_survei2',
                                       'kerusakan.petugas_survei3 as petugas_survei3',
                                       'kerusakan.perwakilan_opd1 as perwakilan_opd1',
                                       'kerusakan.perwakilan_opd2 as perwakilan_opd2',
                                       'kerusakan.tanggal as tanggal',
                                       'gedung.id as id_gedung',
                                       'gedung.nama as nama_gedung',
                                       'gedung.luas as luas', 
                                       'gedung.jumlah_lantai as jml_lantai')
                                ->join('gedung', 'kerusakan.id_gedung', '=', 'gedung.id')
                                ->where('kerusakan.id', $id_kerusakan)
                                ->first();
        
        $gedung = Gedung::select('gedung.id as id_gedung')->join('kerusakan', 'gedung.id', '=', 'kerusakan.id_gedung')->where('kerusakan.id', $id_kerusakan)->first();
        $daerah = Gedung::select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->where('id', $gedung->id_gedung)->first();
        $provinsi = Provinsi::select('provinsi.nama as nama_provinsi')->where('id_prov', $daerah->kode_provinsi)->first();
        $kab_kota = KabupatenKota::select('kota.nama as nama_kota')->where('id_kota', $daerah->kode_kabupaten)->first();
        $kecamatan = Kecamatan::select('kecamatan.nama as nama_kecamatan')->where('id_kec', $daerah->kode_kecamatan)->first();
        $desa_kelurahan = DesaKelurahan::select('kelurahan.nama as nama_kelurahan')->where('id_kel', $daerah->kode_kelurahan)->first();
        
        $komponen = DB::table('komponen as t1')
            ->select('t2.id as id_komponen',
                     't1.nama as nama_komponen', 
                     't2.nama as sub_komponen', 
                     'satuan.id as id_satuan', 
                     'satuan.nama as nama_satuan',
                     'kerusakan_detail.tingkat_kerusakan'
                     )
            ->rightjoin('komponen as t2', 't1.id', '=', 't2.id_parent')
            ->join('satuan', 't2.id_satuan', '=', 'satuan.id')
            ->join('kerusakan_detail', 't2.id', '=', 'kerusakan_detail.id_komponen')
            ->orderBy('t1.id', 'asc')->get();
        return view('Kerusakan/edit_view_master_kerusakan', compact('kerusakan', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'komponen'));
    }

    public function postSubmitEditKerusakan(Request $request) {
        $data = $request->all();
        //Log::info($data);

        $id_gedung = $data['id_gedung'];
        $id_komp = $data['id_komp'];
        $tanggal_jam = $data['tanggal_jam'];
        $id_komponen_opsi = $data['id_komp_opsi'];
        $jumlah = $data['jumlah'];
        $tingkat_kerusakan = $data['tingkat_kerusakan'];
        $input_nilai_klsf = $data['input_nilai_klsf'];
        $klasifikasi = $data['klasifikasi'];
        Log::info($data);

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
        for ($i = 0; $i < count($id_komp); $i++) {
            $input_detail = new KerusakanDetail;
            $input_detail->id_kerusakan = $input_tbl_kerusakan->id;
            $input_detail->id_komponen = $id_komp[$i];
            $input_detail->id_komponen_opsi = $id_komponen_opsi[$i];
            $input_detail->jumlah = $jumlah[$i];
            $input_detail->tingkat_kerusakan = $tingkat_kerusakan[$i];
            $input_detail->save();

            for ($j = 0; $j < count($klasifikasi); $j++) {
                for ($k = 0; $k < count($klasifikasi[$j]); $k++) {
                    $input_klasifikasi = new KerusakanKlasifikasi;
                    $input_klasifikasi->id_kerusakan_detail = $input_detail->id;
                    $input_klasifikasi->nilai_input_klasifikasi = $input_nilai_klsf[$j][$k];
                    $input_klasifikasi->klasifikasi = $klasifikasi[$j][$k];
                    $input_klasifikasi->save();
                }
            }

        }
        
        return response()->json(['message', 'Input sukses']);
    }

    public function importExcelKerusakan(Request $request) {
        // Pindah file ke folder public
        $file = $request->file('file_excel');
        $path = public_path();
        $file->move($path, $file->getClientOriginalName());

        // Import file
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $inputFileType = 'Xlsx';
        $inputFileName = $file->getClientOriginalName();
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        //Log::info($highestRow);

        $lines = $highestRow - 1;

        if ($lines <= 0) {
            echo "<script>alert('Tidak ada data di dalam tabel Excel')</script>";
        }

        $kerusakan = new Kerusakan;
        $kerusakan->opd = $worksheet->getCellByColumnAndRow(5, 3)->getValue();
        $nama_gedung = $worksheet->getCellByColumnAndRow(5, 4)->getValue();
        $nama_like = '%'.$nama_gedung.'%';
        $id_gedung = Gedung::where('nama', 'like', $nama_like)->first();
        $kerusakan->id_gedung = $id_gedung->id;
        $kerusakan->nomor_aset = $worksheet->getCellByColumnAndRow(5, 5)->getValue();
        $val_tgl = $worksheet->getCell('E8')->getValue(); $val_jam = $worksheet->getCellByColumnAndRow(8, 12)->getValue();
        $tgl = date('Y-m-d', ($val_tgl-25569)*86400);
        $jam = date('H:i:s', (($val_jam-25569)*3600)-25200);
        //Log::info($tgl.' '.$jam);
        $kerusakan->tanggal = $tgl.' '.$jam;
        $kerusakan->petugas_survei1 = substr($worksheet->getCellByColumnAndRow(5, 9)->getValue(), 2);
        $kerusakan->petugas_survei2 = substr($worksheet->getCellByColumnAndRow(5, 10)->getValue(), 2);
        $kerusakan->petugas_survei3 = substr($worksheet->getCellByColumnAndRow(5, 11)->getValue(), 2);
        $kerusakan->perwakilan_opd1 = substr($worksheet->getCellByColumnAndRow(5, 12)->getValue(), 2);
        $kerusakan->perwakilan_opd2 = substr($worksheet->getCellByColumnAndRow(5, 13)->getValue(), 2);
        //$kerusakan->save();
        //Log::info($kerusakan);

        $gedung = Gedung::where('id', $kerusakan->id_gedung)->first();
        $alamat1 = $worksheet->getCell('E6')->getValue();
        $alamat2 = $worksheet->getCell('E7')->getValue();
        $gedung->alamat = $alamat1.' '.$alamat2;
        $gedung->luas = $worksheet->getCellByColumnAndRow(5, 14)->getValue();
        $gedung->jumlah_lantai = $worksheet->getCellByColumnAndRow(14, 14)->getValue();
        //$gedung->save();
        Log::info($gedung);

        /*
        for ( $row = 21; $row <= ($highestRow - 1); ++$row ) {
            if($nama_komponen == "") break; // mencegah pembacaan row melebihi row yang dibutuhkan
            $detail = new KerusakanDetail;
            $detail->id_kerusakan = $kerusakan->id;
            $nama_komponen = $worksheet->getCellByColumnAndRow('C', $row)->getValue();
            $detail->id_komponen = Komponen::select('komponen.id as id')->where('nama', 'like', '%', $nama_komponen, '%');
            $nama_subkomponen = $worksheet->getCellByColumnAndRow('D', $row)->getValue();
            $detail->jumlah = $worksheet->getCellByColumnAndRow('G', $row)->getValue();
            $detail->id_komponen = Komponen::select('komponen.id as id')->where('nama', 'like', '%', $nama_komponen, '%');
            $satuan = $worksheet->getCellByColumnAndRow('F', $row)->getValue();
            if ($satuan == 'estimasi') {
                $opsi = $worksheet->getCellByColumnAndRow('I', $row)->getValue();
                $detail->id_komponen_opsi = KomponenOpsi::select('komponen_opsi.id as id')->where('opsi', 'like', '%', $opsi, '%');
            } else if ($satuan == 'unit') {
                
            } else if ($satuan == '%') {

            }
            $detail->tingkat_kerusakan = $worksheet->getCellByColumnAndRow('S', $row)->getValue();
            //$detail->save();
        }

        //return redirect('master_kerusakan');*/
    }

}
