<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;
use App\Komponen;

class KerusakanController extends Controller
{
    public function pilihanGedung () {
        $gedung = Gedung::get();
        return view('Kerusakan/tambah_master_kerusakan', compact('gedung'));
    }

    public function formKlsfKerusakan () {
        $komponen = Komponen::join('komponen as t1', '', '=', '')->join('satuan', 'komponen.id_satuan' , '=', 'satuan.id')->select('komponen.*', 'satuan.id as id_satuan', 'satuan.nama as nama_satuan')->get();
        return view('Kerusakan/view_master_kerusakan', compact('komponen'));
    }
}
