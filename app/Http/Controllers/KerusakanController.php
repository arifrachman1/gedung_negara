<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gedung;

class KerusakanController extends Controller
{
    public function pilihanGedung () {
        $gedung = Gedung::get();
        return view('Kerusakan/tambah_master_kerusakan', compact('gedung'));
    }
}
