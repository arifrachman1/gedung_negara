<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;
use App\KategoriGedung;
use App\Provinsi;
use App\KabupatenKota;
use App\Kecamatan;
use App\DesaKelurahan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PDF;
use Log;

class GedungController extends Controller
{
    public function index() {
        $gedung = Gedung::get();
        return view('Gedung/master_gedung', compact('gedung'));
    }

    public function detail($id) {
        $detail_gedung = Gedung::select(
                'gedung.id as id',
                'gedung.nama as nama',
                'gedung.nomor_seri as nomor_seri',
                'gedung.alamat as alamat',
                'gedung.bujur_timur as bujur_timur',
                'gedung.lintang_selatan as lintang_selatan',
                'gedung.legalitas as legalitas',
                'gedung.alas_hak as alas_hak',
                'gedung.luas_lahan as luas_lahan',
                'gedung.jumlah_lantai as jumlah_lantai',
                'gedung.luas as luas_bangunan',
                'gedung.tinggi as tinggi_bangunan',
                'gedung.kompleks as kompleks',
                'gedung.kepadatan as kepadatan',
                'gedung.permanensi as permanensi',
                'gedung.tkt_resiko_kebakaran as risk_bakar',
                'gedung.penangkal_petir as penangkal',
                'gedung.struktur_bawah as struktur_bawah',
                'gedung.struktur_bangunan as struktur_bangunan',
                'gedung.struktur_atap as struktur_atap',
                'gedung.kdb as kdb',
                'gedung.klb as klb',
                'gedung.kdh as kdh',
                'gedung.gsb as gsb',
                'gedung.rth as rth',
            )->where('gedung.id', $id)->first();
        $nama_kat = KategoriGedung::select('gedung_ketegori.nama as nama_kategori')
                    ->join('gedung', 'gedung_ketegori.id', '=', 'gedung.id_gedung_kategori')
                    ->where('gedung.id', $id)->first();
        $daerah = Gedung::where('id', $id)->select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->first();
        $provinsi = Provinsi::where('id_prov', $daerah->kode_provinsi)->select('provinsi.nama as nama')->first();
        //dd($provinsi);
        $kab_kota = KabupatenKota::where('id_kota', $daerah->kode_kabupaten)->select('kota.nama as nama')->first();
        $kecamatan = Kecamatan::where('id_kec', $daerah->kode_kecamatan)->select('kecamatan.nama as nama')->first();
        $desa_kelurahan = DesaKelurahan::where('id_kel', $daerah->kode_kelurahan)->select('kelurahan.nama as nama')->first();
        //dd($detail_gedung);
        return view('Gedung/detail_master_gedung', compact('detail_gedung', 'nama_kat', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan'));
    }

    public function exportPDFDetailGedung($id){
        $detail_gedung = Gedung::select(
                'gedung.id as id',
                'gedung.nama as nama',
                'gedung.nomor_seri as nomor_seri',
                'gedung.alamat as alamat',
                'gedung.bujur_timur as bujur_timur',
                'gedung.lintang_selatan as lintang_selatan',
                'gedung.legalitas as legalitas',
                'gedung.alas_hak as alas_hak',
                'gedung.luas_lahan as luas_lahan',
                'gedung.jumlah_lantai as jumlah_lantai',
                'gedung.luas as luas_bangunan',
                'gedung.tinggi as tinggi_bangunan',
                'gedung.kompleks as kompleks',
                'gedung.kepadatan as kepadatan',
                'gedung.permanensi as permanensi',
                'gedung.tkt_resiko_kebakaran as risk_bakar',
                'gedung.penangkal_petir as penangkal',
                'gedung.struktur_bawah as struktur_bawah',
                'gedung.struktur_bangunan as struktur_bangunan',
                'gedung.struktur_atap as struktur_atap',
                'gedung.kdb as kdb',
                'gedung.klb as klb',
                'gedung.kdh as kdh',
                'gedung.gsb as gsb',
                'gedung.rth as rth',
            )->where('gedung.id', $id)->first();
        $nama_kat = KategoriGedung::select('gedung_ketegori.nama as nama_kategori')
                    ->join('gedung', 'gedung_ketegori.id', '=', 'gedung.id_gedung_kategori')
                    ->where('gedung.id', $id)->first();
        $daerah = Gedung::where('id', $id)->select('gedung.kode_provinsi', 'gedung.kode_kabupaten', 'gedung.kode_kecamatan', 'gedung.kode_kelurahan')->first();
        $provinsi = Provinsi::where('id_prov', $daerah->kode_provinsi)->select('provinsi.nama as nama')->first();
        $kab_kota = KabupatenKota::where('id_kota', $daerah->kode_kabupaten)->select('kota.nama as nama')->first();
        $kecamatan = Kecamatan::where('id_kec', $daerah->kode_kecamatan)->select('kecamatan.nama as nama')->first();
        $desa_kelurahan = DesaKelurahan::where('id_kel', $daerah->kode_kelurahan)->select('kelurahan.nama as nama')->first();

        $pdf = PDF::loadView('Gedung/detail_gedung_pdf', compact('detail_gedung', 'nama_kat', 'provinsi', 'kab_kota', 'kecamatan', 'desa_kelurahan'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($detail_gedung->nama .''. now()->toDateString() .'.pdf');
    }

    public function input(Request $request) {
        $jenis_gedung = KategoriGedung::get();
        $daerah = Provinsi::get();
        return view('Gedung/tambah_master_gedung', compact('jenis_gedung', 'daerah'));
    }

    public function getKabKota($id) {
        $kabKota = Provinsi::where('id_prov', $id)->with('kabupatenKota')->get();
        //Log::info($kabKota);
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
        $input->nomor_seri = $request->nomor_seri;
        $input->alamat = $request->alamat;
        $input->bujur_timur = $request->bt;
        $input->lintang_selatan = $request->ls;
        $input->legalitas = $request->legalitas;
        $input->tipe_pemilik = $request->tipe_pemilik;
        $input->alas_hak = $request->alas_hak;
        $input->luas_lahan = $request->luas_lahan;
        $input->jumlah_lantai = $request->jumlah_lantai;
        $input->luas = $request->luas_bangunan;
        $input->tinggi = $request->tinggi_bangunan;
        $input->kompleks = $request->kompleks;
        $input->kepadatan = $request->kepadatan;
        $input->permanensi = $request->permanensi;
        $input->tkt_resiko_kebakaran = $request->rsk_kebakaran;
        $input->penangkal_petir = $request->penangkal_petir;
        $input->struktur_bawah = $request->struktur_bawah; 
        $input->struktur_bangunan = $request->struktur_bangunan;
        $input->struktur_atap = $request->struktur_atap;
        $input->kode_provinsi = $request->kode_provinsi;
        $input->kode_kabupaten = $request->kode_kabupaten;
        $input->kode_kecamatan = $request->kode_kecamatan;
        $input->kode_kelurahan = $request->kode_kelurahan;
        $input->kdb = $request->kdb;
        $input->klb = $request->klb;
        $input->kdh = $request->kdh;
        $input->gsb = $request->gsb;
        $input->rth = $request->rth;
        $input->save();
        return redirect('master_gedung');
    }

    public function edit($id) {
        $daerah = Provinsi::get();
        $kategori = KategoriGedung::get();
        $edit = Gedung::find($id);
        return view('Gedung/edit_master_gedung', compact('edit', 'kategori', 'daerah'));
    }

    public function edit_post($id, Request $request) {
        $edit = Gedung::find($id);
        $edit->nama = $request->nama_gd;
        $edit->id_gedung_kategori = $request->kategori_gd;
        $edit->nomor_seri = $request->nomor_seri;
        $edit->alamat = $request->alamat;
        $edit->bujur_timur = $request->bt;
        $edit->lintang_selatan = $request->ls;
        $edit->legalitas = $request->legalitas;
        $edit->tipe_pemilik = $request->tipe_pemilik;
        $edit->alas_hak = $request->alas_hak;
        $edit->luas_lahan = $request->luas_lahan;
        $edit->jumlah_lantai = $request->jumlah_lantai;
        $edit->luas = $request->luas_bangunan;
        $edit->tinggi = $request->tinggi_bangunan;
        $edit->kompleks = $request->kompleks;
        $edit->kepadatan = $request->kepadatan;
        $edit->permanensi = $request->permanensi;
        $edit->tkt_resiko_kebakaran = $request->rsk_kebakaran;
        $edit->penangkal_petir = $request->penangkal_petir;
        $edit->struktur_bawah = $request->struktur_bawah; 
        $edit->struktur_bangunan = $request->struktur_bangunan;
        $edit->struktur_atap = $request->struktur_atap;
        $edit->kode_provinsi = $request->kode_provinsi;
        $edit->kode_kabupaten = $request->kode_kabupaten;
        $edit->kode_kecamatan = $request->kode_kecamatan;
        $edit->kode_kelurahan = $request->kode_kelurahan;
        $edit->kdb = $request->kdb;
        $edit->klb = $request->klb;
        $edit->kdh = $request->kdh;
        $edit->gsb = $request->gsb;
        $edit->rth = $request->rth;
        $edit->save();
        return redirect('master_gedung');
    }

    public function delete(Request $request) {
        $delete = Gedung::find($request->id);
        $delete->delete();
        return redirect('master_gedung');
    }

    public function exportExcel() {
        $inputFileName = '../storage/excel_template/temp_gedung.xlsx';

        /** Load $inputFileName to a Spreadsheet object **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $sheet = $spreadsheet->getActiveSheet();
        $data = Gedung::get();
        //dd($data);
        $i = 1;
        foreach($data as $d){
            $i++;
            $sheet->setCellValue('A'.$i, ($i-1));
            $sheet->setCellValue('B'.$i, $d->nama);
            $sheet->setCellValue('C'.$i, $d->alamat);
            $sheet->setCellValue('D'.$i, $d->bujur_timur);
            $sheet->setCellValue('E'.$i, $d->lintang_selatan);
            $sheet->setCellValue('F'.$i, $d->legalitas);
            $sheet->setCellValue('G'.$i, $d->tipe_pemilik);
            $sheet->setCellValue('H'.$i, $d->alas_hak);
            $sheet->setCellValue('I'.$i, $d->luas_lahan);
            $sheet->setCellValue('J'.$i, $d->jumlah_lantai);
            $sheet->setCellValue('K'.$i, $d->luas);
            $sheet->setCellValue('L'.$i, $d->tinggi);
            $sheet->setCellValue('M'.$i, $d->kompleks);
            $sheet->setCellValue('N'.$i, $d->kepadatan);
            $sheet->setCellValue('O'.$i, $d->permanensi);
            $sheet->setCellValue('P'.$i, $d->tkt_resiko_kebakaran);
            $sheet->setCellValue('Q'.$i, $d->penangkal_petir);
            $sheet->setCellValue('R'.$i, $d->struktur_bawah);
            $sheet->setCellValue('S'.$i, $d->struktur_bangunan);
            $sheet->setCellValue('T'.$i, $d->struktur_atap);
            $sheet->setCellValue('U'.$i, $d->kdb);
            $sheet->setCellValue('V'.$i, $d->klb);
            $sheet->setCellValue('W'.$i, $d->kdh);
            $sheet->setCellValue('X'.$i, $d->gsb);
            $sheet->setCellValue('Y'.$i, $d->rth);
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('master_gedung.xlsx');
        return redirect('master_gedung.xlsx');
    }

    public function importExcel(Request $request) {
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $inputFileType = 'Xlsx';
        $inputFileName = $request->file_excel;
        $reader = IOFactory::createReader($inputFileType);
        $spreadsheet = $reader->load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        $highestRow = $worksheet->getHighestRow();
        $highestColumn = $worksheet->getHighestColumn();
        $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);

        $lines = $highestRow - 1;

        if ($lines <= 0) {
            echo "<script>alert('Tidak ada data di dalam tabel Excel')</script>";
        }

        for ( $row = 2; $row <= $highestRow; ++$row ) {
            $sql = new Gedung;

            $sql->nomor_seri = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
            $sql->nama = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
            $sql->alamat = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $sql->bujur_timur = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $sql->lintang_selatan = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $sql->legalitas = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $sql->tipe_pemilik = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            $sql->alas_hak = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            $sql->luas_lahan = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
            $sql->jumlah_lantai = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
            $sql->luas = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
            $sql->tinggi = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
            $sql->kompleks = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
            $sql->kepadatan = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
            $sql->permanensi = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
            $sql->tkt_resiko_kebakaran = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
            $sql->penangkal_petir = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
            $sql->struktur_bawah = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
            $sql->struktur_bangunan = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
            $sql->struktur_atap = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
            $sql->kdb = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
            $sql->klb = $worksheet->getCellByColumnAndRow(22, $row)->getValue();
            $sql->kdh = $worksheet->getCellByColumnAndRow(23, $row)->getValue();
            $sql->gsb = $worksheet->getCellByColumnAndRow(24, $row)->getValue();
            $sql->rth = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
            $sql->save();
        }

        return redirect('master_gedung');
    }

    public function exportPDF() {
        $gedung = Gedung::all();
        
        $pdf = PDF::loadView('Gedung/gedung_pdf', compact('gedung'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('Rekap Data Gedung '. now()->toDateString() .'.pdf');
    }

}
