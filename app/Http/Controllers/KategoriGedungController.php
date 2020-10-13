<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KategoriGedung;

class KategoriGedungController extends Controller
{
    public function index() {
        return view('', compact(''));
    }

    public function input() {

    }

    public function input_action() {
        $input = new KategoriGedung;
        $input->nama = "Gedung Sekolah";
        $input->save();
    }

    public function edit() {

    }

    public function edit_post() {

    }

    public function delete() {

    }
}
