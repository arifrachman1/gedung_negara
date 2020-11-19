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
use App\SketsaDenah;
use App\GambarBukti;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PDF;
use Log;
use Illuminate\Support\Facades\Validator;

class KerusakanController extends Controller
{
    private $opsi_index = 0;
    public function index() {
        $kerusakan = Kerusakan::select('kerusakan.id as id','gedung.nama as nama_gedung', 'gedung_ketegori.nama as jenis_gd', 'gedung.alamat as alamat')
                                ->join('gedung', 'kerusakan.id_gedung', '=', 'gedung.id')
                                ->join('gedung_ketegori', 'gedung.id_gedung_kategori', '=', 'gedung_ketegori.id')
                                ->whereNull('gedung.deleted_at')
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
            ->whereNull('deleted_at')
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

        $kerusakan_data = [
            "id_gedung" => $id_gedung,
        ];
        return view('Kerusakan/create_formulir_klasifikasi_kerusakan', compact('komponens', 'gedung', 'daerah', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'id_gedung', 'id_user', 'kerusakan_data'));
    }
    private function setCellDropdown($sheet, $opsiSheet, $currentRow, $options, $selected = 0){
        $cellAddr   = "L$currentRow";
        $cellResult = "V$currentRow";
        $cellBobot  = "K$currentRow";

        
        // set opsi . $this->opsi_index
        $this->opsi_index += 3;
        $first_opsi = $this->opsi_index;
        $selected_opsi = null;
        foreach($options as $i => $o){
            if($i == 0) $selected_opsi = $o->opsi;
            if($o->id == $selected) $selected_opsi = $o->opsi;
            $opsiSheet->setCellValue('B'.$this->opsi_index, $o->opsi);
            $opsiSheet->setCellValue('C'.$this->opsi_index, $o->nilai/100);
            $opsiSheet->setCellValue('D'.$this->opsi_index, $o->id);
            $this->opsi_index++;
        }
        $last_opsi = $this->opsi_index - 1;

        // set dropdown
        $validation = $sheet->getCell($cellAddr)
            ->getDataValidation();
        $validation->setType( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_LIST );
        $validation->setErrorStyle( \PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_INFORMATION );
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Input error');
        $validation->setError('Value is not in list.');
        $validation->setPromptTitle('Opsi kerusakan');
        $validation->setPrompt('Silahkan pilih kerusakan');
        $validation->setFormula1('Opsi!$B$'.$first_opsi.':$B$'.$last_opsi);
        if($selected_opsi !== null)
            $sheet->setCellValue($cellAddr, $selected_opsi);
        $sheet->setCellValue($cellResult, '=(VLOOKUP('.$cellAddr.', \'Opsi\'!$B$'.$first_opsi.':$D$'.$last_opsi.', 2, 0) * '.$cellBobot .')/100');
    }
    public function exportKerusakan(Request $request){
        
        $opd        = Session::get('opd');
        $nomorAset  = Session::get('nomor_aset');
        $surveyor1  = Session::get('surveyor1');
        $surveyor2  = Session::get('surveyor2'); 
        $surveyor3  = Session::get('surveyor3');
        $pwopd1     = Session::get('pwopd1');
        $pwopd2     = Session::get('pwopd2');
        $dateNow    = date('Y-m-d');
        $timeNow    = date('H:i:s');

        $id_gedung = $request->get('id_gedung');
        $id_kerusakan = $request->get('id_kerusakan');
        $gedung = Gedung::where('id', $id_gedung)->first();
        $daerah = Gedung::select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->where('id', $id_gedung)->first();
        $provinsi = Provinsi::select('provinsi.nama as nama_provinsi')->where('id_prov', $daerah->kode_provinsi)->first();
        $kab_kota = KabupatenKota::select('kota.nama as nama_kota')->where('id_kota', $daerah->kode_kabupaten)->first();
        $kecamatan = Kecamatan::select('kecamatan.nama as nama_kecamatan')->where('id_kec', $daerah->kode_kecamatan)->first();
        $desa_kelurahan = DesaKelurahan::select('kelurahan.nama as nama_kelurahan')->where('id_kel', $daerah->kode_kelurahan)->first();


        /**
         * Jika data kerusakan sudah terisi
         */

        $kerusakan_ob = ["kerusakan_detail" => []];
        if($id_kerusakan !== null && ($kerusakan = Kerusakan::where('id', $id_kerusakan)->first()) !== null){
            $kerusakan_detail = KerusakanDetail::where('id_kerusakan', $id_kerusakan)->get();
            
            $opd        = $kerusakan->opd;
            $nomorAset  = $kerusakan->nomor_aset;
            $surveyor1  = $kerusakan->petugas_survei1;
            $surveyor2  = $kerusakan->petugas_survei2; 
            $surveyor3  = $kerusakan->petugas_survei3;
            $pwopd1     = $kerusakan->perwakilan_opd1;
            $pwopd2     = $kerusakan->perwakilan_opd2;
            foreach($kerusakan_detail as $kd){
                $kk = [];
                $kerusakan_klasifikasi = KerusakanKlasifikasi::where('id_kerusakan_detail', $kd->id)->get();
                foreach($kerusakan_klasifikasi as $_kk){
                    $kk[$_kk->klasifikasi] = $_kk;
                }
                $opsi = KomponenOpsi::select("id", "opsi")->where('id', $kd->id_komponen_opsi)->first();
                $kerusakan_ob['kerusakan_detail'][$kd->id_komponen] = [
                    "detail" => $kd,
                    "opsi" => ($opsi !== null)? $opsi->opsi:null,
                    "kerusakan_klasifikasi" => $kk
                ];

            }
        }

        $temp_file = storage_path('excel_template').'/temp_kerusakan.xlsx';
        $output_file = storage_path('app/public/excel/kerusakan').'/temp_kerusakan.xlsx';

        /** Load $inputFileName to a Spreadsheet object **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($temp_file);
        $spreadsheet->setActiveSheetIndexByName('Opsi');
        // FORM KERUSAKAN
        $sheetOpsi = $spreadsheet->getActiveSheet();
        $spreadsheet->setActiveSheetIndexByName('FORM KERUSAKAN');
        $sheet = $spreadsheet->getActiveSheet();
        
        /**
         * Header - detail gedung
         */

        $sheet->setCellValue('G3', $opd);
        $sheet->setCellValue('G4', $gedung->nama);
        $sheet->setCellValue('G5', $nomorAset);
        $sheet->setCellValue('G6', $gedung->alamat);
        // $sheet->setCellValue('G8', date('Y-m-d H:i:s'));
        $sheet->setCellValue('G9', $surveyor1);
        $sheet->setCellValue('G10', $surveyor2);
        $sheet->setCellValue('G11', $surveyor3);
        $sheet->setCellValue('G12', $pwopd1);
        $sheet->setCellValue('G13', $pwopd2);
        $sheet->setCellValue('G14', $gedung->luas);
        $sheet->setCellValue('O8', $timeNow);
        $sheet->setCellValue('Q14', $gedung->jumlah_lantai);

        /**
         * Get komponen kerusakan
         */
        
        $id_parents = DB::table('komponen as prnt')
            ->select('prnt.id_parent as id')
            ->join('komponen as chld', 'chld.id', '=', 'prnt.id_parent')
            ->groupBy('prnt.id_parent')
            ->get()->pluck('id')->toArray();
        $komponens = DB::table('komponen')
            ->select('id', 'nama')
            ->whereNull('deleted_at')
            ->whereIn('id', $id_parents)
            ->get();
        foreach ($komponens as $parent) {
            $subKomponen = DB::table('komponen as kom')
                ->select('kom.id', 'kom.id_parent', 'kom.nama', 'kom.bobot', 'sat.id as id_satuan', 'sat.nama as satuan')
                ->join('satuan as sat', 'sat.id', '=', 'kom.id_satuan')
                ->where('id_parent', $parent->id)
                ->get();
            foreach ($subKomponen as &$sk) {
                if($sk->id_satuan == 1){
                    $sk->options = DB::table('komponen_opsi as ko')
                        ->where('ko.id_komponen', $sk->id)
                        ->get();
                }
            }
            $parent->numberOfSub = count($subKomponen);
            $parent->subKomponen = $subKomponen;
        }

        // $jml_sub_komp = -1;
        // foreach ($komponens as $komponen) 
        //     foreach ($komponen->subKomponen as $subKomponen) 
        //         $jml_sub_komp++;
        $indexStartKomponen = 21;
        $numbering = 1;
        $currentRow = $indexStartKomponen;
        foreach ($komponens as $indexKomponen => $komponen) {
            $sheet->setCellValue('C'.$currentRow, $komponen->id );
            $sheet->setCellValue('D'.$currentRow, $komponen->nama );
            foreach ($komponen->subKomponen as $indexSubKomponen => $subKomponen) {
                $sheet->setCellValue('B'.$currentRow, $numbering++ );
                $sheet->setCellValue('E'.$currentRow, $subKomponen->id );
                $sheet->setCellValue('F'.$currentRow, $subKomponen->nama );
                $sheet->mergeCells("F$currentRow:G$currentRow");
                $sheet->setCellValue('H'.$currentRow, $subKomponen->id_satuan );
                $sheet->setCellValue('I'.$currentRow, $subKomponen->satuan );
                $sheet->setCellValue('K'.$currentRow, $subKomponen->bobot );
                
                if($subKomponen->id_satuan == 1){
                    $sheet->mergeCells("L$currentRow:U$currentRow");
                    $this->setCellDropdown($sheet, $sheetOpsi, $currentRow, $subKomponen->options);
                }else{
                    if($subKomponen->id_satuan == 2){
                        $cr = $currentRow;

                        //set format persen
                        $sheet->getStyle('L'.$cr)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                        $sheet->getStyle('N'.$cr)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                        $sheet->getStyle('P'.$cr)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                        $sheet->getStyle('R'.$cr)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);
                        $sheet->getStyle('T'.$cr)->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_PERCENTAGE);

                        // implement formula
                        $sheet->setCellValue('M'.$cr, '=$L'.$cr.'*$L$19');
                        $sheet->setCellValue('O'.$cr, '=$N'.$cr.'*$N$19');
                        $sheet->setCellValue('Q'.$cr, '=$P'.$cr.'*$P$19');
                        $sheet->setCellValue('S'.$cr, '=$R'.$cr.'*$R$19');
                        $sheet->setCellValue('U'.$cr, '=$T'.$cr.'*$T$19');
                        $sheet->setCellValue(
                            'V'.$cr, 
                            '=((M'.$cr.'+O'.$cr.'+Q'.$cr.'+S'.$cr.'+U'.$cr.')*$K'.$cr.')/100'
                        );
                    }else{
                        $cr = $currentRow;

                        //set default jumlah
                        $sheet->setCellValue('J'.$cr, '1');

                        // implement formula
                        $sheet->setCellValue('M'.$cr, '=($L'.$cr.'/$J'.$cr.')*$L$19');
                        $sheet->setCellValue('O'.$cr, '=($N'.$cr.'/$J'.$cr.')*$N$19');
                        $sheet->setCellValue('Q'.$cr, '=($P'.$cr.'/$J'.$cr.')*$P$19');
                        $sheet->setCellValue('S'.$cr, '=($R'.$cr.'/$J'.$cr.')*$R$19');
                        $sheet->setCellValue('U'.$cr, '=($T'.$cr.'/$J'.$cr.')*$T$19');
                        $sheet->setCellValue(
                            'V'.$cr, 
                            '=((M'.$cr.'+O'.$cr.'+Q'.$cr.'+S'.$cr.'+U'.$cr.')*$K'.$cr.')/100'
                        );
                    }

                    if(isset($kerusakan_ob["kerusakan_detail"][$subKomponen->id])){
                        $kd = $kerusakan_ob["kerusakan_detail"][$subKomponen->id];
                        if( $kd["detail"]->jumlah)
                            $sheet->setCellValue('J'.$cr, $kd["detail"]->jumlah);
                        if($kd["kerusakan_klasifikasi"][0.2]->nilai_input_klasifikasi != 0.0)
                            $sheet->setCellValue('L'.$cr, $kd["kerusakan_klasifikasi"][0.2]->nilai_input_klasifikasi);
                        if($kd["kerusakan_klasifikasi"][0.4]->nilai_input_klasifikasi != 0.0)
                            $sheet->setCellValue('N'.$cr, $kd["kerusakan_klasifikasi"][0.4]->nilai_input_klasifikasi);
                        if($kd["kerusakan_klasifikasi"][0.6]->nilai_input_klasifikasi != 0.0)
                            $sheet->setCellValue('P'.$cr, $kd["kerusakan_klasifikasi"][0.6]->nilai_input_klasifikasi);
                        if($kd["kerusakan_klasifikasi"][0.8]->nilai_input_klasifikasi != 0.0)
                            $sheet->setCellValue('R'.$cr, $kd["kerusakan_klasifikasi"][0.8]->nilai_input_klasifikasi);
                        if($kd["kerusakan_klasifikasi"][1.0]->nilai_input_klasifikasi != 0.0)
                            $sheet->setCellValue('T'.$cr, $kd["kerusakan_klasifikasi"][1.0]->nilai_input_klasifikasi);
                    }
                }
                $currentRow++;
            }
        }
        $sheet->removeRow($currentRow, 40-$currentRow+$indexStartKomponen);
        $sheet->setCellValue("V".$currentRow, '=(SUM(V'.$indexStartKomponen.':V'.($currentRow-1).'))');
        // petugas survey
        $writer = new Xlsx($spreadsheet);
        $writer->save($output_file);
        //  $output_file;
        return redirect('/storage/excel/kerusakan/temp_kerusakan.xlsx');
    }
    public function importKerusakan(Request $request){
        
        $resp = [
            "status" => 300,
            "message" => "Error"
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:100',
            'excel_kerusakan_file' => 'required|mimes:xlsx|max:10140'
        ]);
        if ($validator->fails()) {
            $resp["message"] = "Upload file dengan format excel";
            return response()->json($resp);
        }
        $gedung = Gedung::where('id', $request->id_gedung)->first();
        $extension = $request->excel_kerusakan_file->extension();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $inputFileType = 'Xlsx';
        $inputFileName = $request->excel_kerusakan_file;
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $spreadsheet->setActiveSheetIndexByName('FORM KERUSAKAN');
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        /**
         * get header
         */
        
        $surveyor = [];
        $pwopd = [];
        $opd = $worksheet->getCellByColumnAndRow(7, 3)->getValue();
        $nomorAset = $worksheet->getCellByColumnAndRow(7, 5)->getValue();
        $surveyor[] = $worksheet->getCellByColumnAndRow(7, 9)->getValue();
        $surveyor[] = $worksheet->getCellByColumnAndRow(7, 10)->getValue();
        $surveyor[] = $worksheet->getCellByColumnAndRow(7, 11)->getValue();
        $pwopd[] = $worksheet->getCellByColumnAndRow(7, 12)->getValue();
        $pwopd[] = $worksheet->getCellByColumnAndRow(7, 13)->getValue();

        // Create data ke table kerusakan

        DB::beginTransaction();
        try{
            $newKerusakan = new Kerusakan;
            $newKerusakan->id_gedung         = $gedung->id;
            $newKerusakan->tanggal           = date('Y-m-d H:i:s');
            $newKerusakan->opd               = $opd;
            $newKerusakan->nomor_aset        = $nomorAset;
            $newKerusakan->petugas_survei1   = $surveyor[0];
            $newKerusakan->petugas_survei2   = $surveyor[1];
            $newKerusakan->petugas_survei3   = $surveyor[2];
            $newKerusakan->perwakilan_opd1   = $pwopd[0];
            $newKerusakan->perwakilan_opd2   = $pwopd[1];
            $newKerusakan->created_at        = date('Y-m-d H:i:s');
            $newKerusakan->save();

            $indexStartKomponen = 21;
            for ($row = $indexStartKomponen; $row <= $highestRow; $row++) {
                $id_komponen = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $id_sub_komponen = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                $id_satuan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                if($id_satuan === null || $id_satuan == "") break;

                // $tingkat_kerusakan = 0.0;
                // for($i = 0; $i < 5; $i++){
                //     $jumlah_item = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                //     $jumlah_rusak = $worksheet->getCellByColumnAndRow(12+($i*2), $row)->getValue();
                //     if($jumlah_item === null || $jumlah_item == "") $jumlah_item = 0;
                //     if($jumlah_rusak === null || $jumlah_rusak == "") $jumlah_rusak = 0;
                //     $tingkat_kerusakan += ($jumlah_item > 0)? ($jumlah_rusak/$jumlah_item)*(0.2*($i+1)):0;
                // }
                
                // $bobot = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                // if($bobot !== null && $bobot != "") {
                //     $tingkat_kerusakan *= $bobot/100;
                // };
                
                $tingkat_kerusakan = 0;
                $newKerusakanDetail = new KerusakanDetail;
                $newKerusakanDetail->id_kerusakan       = $newKerusakan->id;
                $newKerusakanDetail->id_komponen        = $id_sub_komponen;
                $newKerusakanDetail->tingkat_kerusakan  = $tingkat_kerusakan;
                
                $jumlah_item = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
                if($jumlah_item === null || $jumlah_item == "") $jumlah_item = 0;

                if($id_satuan == 1){
                    $opsi_selected = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
                    $opsi = KomponenOpsi::select("id")
                        ->where('opsi', $opsi_selected)
                        ->where('id_komponen', $id_sub_komponen)
                        ->first();
                    $tingkat_kerusakan = $opsi->nilai/100;
                    $newKerusakanDetail->id_komponen_opsi = $opsi->id;
                    $newKerusakanDetail->save();
                }else{
                    ($jumlah_item != 0) && $newKerusakanDetail->jumlah = $jumlah_item;
                    $newKerusakanDetail->save();
                    for($i = 0; $i < 5; $i++){
                        $jumlah_rusak = $worksheet->getCellByColumnAndRow(12+($i*2), $row)->getValue();
                        if($jumlah_rusak === null || $jumlah_rusak == "") $jumlah_rusak = 0;
                        $nilai_input_klasifikasi = ($jumlah_item > 0)? ($jumlah_rusak/$jumlah_item)*(0.2*($i+1)):0;
                        $tingkat_kerusakan += $nilai_input_klasifikasi;
                        $input_klasifikasi = new KerusakanKlasifikasi;
                        $input_klasifikasi->id_kerusakan_detail     = $newKerusakanDetail->id;
                        $input_klasifikasi->nilai_input_klasifikasi = $jumlah_rusak;
                        $input_klasifikasi->klasifikasi             = 0.2*($i+1);
                        $input_klasifikasi->save();
                    }
                    
                }
                
                $bobot = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
                if($bobot !== null && $bobot != "") {
                    $tingkat_kerusakan *= $bobot/100;
                };
                $newKerusakanDetail->tingkat_kerusakan = $tingkat_kerusakan;
                $newKerusakanDetail->save();
            }
            
            $resp["status"] = 200;
            $resp["message"] = "Success";
            $resp["redirect_to"] = route('kerusakan.view', ['id'=> $newKerusakan->id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            $resp["message"] = "Error. ".$e->getMessage();
        }
        return response()->json($resp);
    }

    public function submitKlasifikasiKerusakan(Request $request){
        $_klasifikasiKerusakan = [0.20, 0.40, 0.60, 0.80, 1.00];
        $timeUpload = strtotime("now");

        DB::beginTransaction();
        try{

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

            //File Bukti
            foreach ($request->gambar_bukti as $index => $gambar_bukti) {
                $buktiExt       = $gambar_bukti->getClientOriginalExtension();
                $buktiFileName  = "bukti_".$timeUpload.'_'.$index.'.'.$buktiExt;
                $gambar_bukti->move('bukti', $buktiFileName);

                $newGambar = new GambarBukti;
                $newGambar->id_kerusakan = $newKerusakan->id;
                $newGambar->gambar_bukti = $buktiFileName;
                $newGambar->created_at   = date('Y-m-d H:i:s');
                $newGambar->save();
            }

            //Files Denah
            foreach ($request->sketsa_denah as $index => $denah) {  
                $denahExt    = $denah->getClientOriginalExtension();
                $denahFileName   =   "denah_".$timeUpload.'_'.$index.'.'.$denahExt;
                $denah->move('denah', $denahFileName);

                $newSketsaDenah = new SketsaDenah;
                $newSketsaDenah->id_kerusakan = $newKerusakan->id;
                $newSketsaDenah->sketsa_denah = $denahFileName;
                $newSketsaDenah->created_at   = date('Y-m-d H:i:s');
                $newSketsaDenah->save();
            }


            DB::commit();
            return redirect()
                ->action('KerusakanController@viewKerusakan', [$newKerusakan->id])
                ->with(['success' => 'Kerusakan berhasil ditambahkan.']);
        } catch(Exception $e){
            DB::rollBack();
            return redirect('master_kerusakan')->with(['error' => 'Error, tambah kerusakan gagal.']);
        }
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
        $status = '';
        if($tingkat_kerusakan == 0){
            $status = "Tidak ada kerusakan";
        } else if ($tingkat_kerusakan <= 30) {
            $status = "Tingkat Kerusakan Rendah";
        } else if ($tingkat_kerusakan > 30 && $tingkat_kerusakan <= 45) {
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
            ->whereNull('deleted_at')
            ->whereIn('id', $id_parents)
            ->get();
        $sumAlltingkatKerusakan = 0;
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
                $sumAlltingkatKerusakan += $sumTingkatKerusakan;
        }
        $sumAlltingkatKerusakanText = $this->mapStatusTingkatKerusakan($sumAlltingkatKerusakan);
        //dd($komponens);

        $kerusakan = Kerusakan::select('kerusakan.opd as opd', 'gedung.nama as nama_gedung', 'gedung.luas as luas', 'gedung.jumlah_lantai as jml_lantai', 'kerusakan.nomor_aset as nomor_aset', 'kerusakan.tanggal as tanggal', 'kerusakan.petugas_survei1 as petugas_survei1', 'kerusakan.petugas_survei2 as petugas_survei2', 'kerusakan.petugas_survei3 as petugas_survei3', 'kerusakan.perwakilan_opd1 as perwakilan_opd1', 'kerusakan.perwakilan_opd2 as perwakilan_opd2')->join('gedung', 'kerusakan.id_gedung', '=', 'gedung.id')->where('kerusakan.id', $id_kerusakan)->first();

        
        $gedung = Gedung::select('gedung.id as id_gedung')->join('kerusakan', 'gedung.id', '=', 'kerusakan.id_gedung')->where('kerusakan.id', $id_kerusakan)->first();
        $daerah = Gedung::select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->where('id', $gedung->id_gedung)->first();
        $provinsi = Provinsi::select('provinsi.nama as nama_provinsi')->where('id_prov', $daerah->kode_provinsi)->first();
        $kab_kota = KabupatenKota::select('kota.nama as nama_kota')->where('id_kota', $daerah->kode_kabupaten)->first();
        $kecamatan = Kecamatan::select('kecamatan.nama as nama_kecamatan')->where('id_kec', $daerah->kode_kecamatan)->first();
        $desa_kelurahan = DesaKelurahan::select('kelurahan.nama as nama_kelurahan')->where('id_kel', $daerah->kode_kelurahan)->first();

        return view('Kerusakan/view_kerusakan', compact('kerusakan', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'komponens', 'sumAlltingkatKerusakan', 'sumAlltingkatKerusakanText'));
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
        $id_parents = KerusakanDetail::select('id_parent as id')
            ->join('komponen', 'komponen.id', '=', 'kerusakan_detail.id_komponen')
            ->where('id_kerusakan', $id_kerusakan)
            ->distinct('komponen.id_parent')->pluck('id')->toArray();
        $komponens = DB::table('komponen')
            ->select('id', 'nama')
            ->whereNull('deleted_at')
            ->whereIn('id', $id_parents)
            ->get();
        foreach ($komponens as $komponen) { 
            $subKomponens = DB::table('kerusakan_detail as kd')
            ->select(
                'kom.id', 'kom.nama', 'kom.bobot', 'kd.id as id_kerusakan_detail', 'kom.id_satuan', 'sat.nama as satuan',
                'kd.tingkat_kerusakan', 'kd.jumlah', 'kd.id_komponen_opsi'
            )
            ->where('id_kerusakan', $id_kerusakan)
            ->where('id_parent', $komponen->id)
            ->join('komponen as kom', 'kom.id', '=', 'kd.id_komponen')
            ->join('satuan as sat', 'sat.id', '=', 'kom.id_satuan')
            ->get()->toArray();

            $sumTingkatKerusakan = 0;
            foreach($subKomponens as $subKomponen){
                if($subKomponen->id_satuan != 1){
                    $subKomponen->kerusakan_klasifikasi = DB::table('kerusakan_klasifikasi')
                        ->where('id_kerusakan_detail', $subKomponen->id_kerusakan_detail)
                        ->get()->toArray();
                }
                $sumTingkatKerusakan += $subKomponen->tingkat_kerusakan;
            }
            $komponen->subKomponen = $subKomponens;
            $komponen->numberOfSub = count($subKomponens);
            $komponen->sumTingkatKerusakan = $sumTingkatKerusakan;
            $komponen->sumTingkatKerusakanText = $this->mapStatusTingkatKerusakan($sumTingkatKerusakan);

        }
        $sketsaDenah = SketsaDenah::where('id_kerusakan', $id_kerusakan)->get();
        $gambarBukti = GambarBukti::where('id_kerusakan', $id_kerusakan)->get();

        // dd($komponens);

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
        
        return view('Kerusakan/edit_view_master_kerusakan', compact('kerusakan', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan', 'komponens', 'sketsaDenah', 'gambarBukti'));
    }

    public function submitEditKerusakanForm(Request $request){
        // die('yeay');
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
