<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Gedung;
use App\Komponen;

class KerusakanController extends Controller
{
    public function pilihanGedung () {
        $gedung = Gedung::get();
        return view('Kerusakan/tambah_master_kerusakan', compact('gedung'));
    }

    public function formKlsfKerusakan () {
        $komponen = DB::table('komponen as t1')
            ->select('t1.nama as nama_komponen', 
                     't2.nama as sub_komponen', 
                     'satuan.id as id_satuan', 
                     'satuan.nama as nama_satuan')
            ->join('komponen as t2', 't2.id_parent', '=', 't1.id')
            ->join('satuan', 't1.id_satuan' , '=', 'satuan.id')
            ->get();
        return view('Kerusakan/view_master_kerusakan', compact('komponen'));
    }
}
