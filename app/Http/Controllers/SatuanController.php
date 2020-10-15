<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Satuan;

class SatuanController extends Controller
{
    public function satuan() {
        $satuan = Satuan::get();
        return view('/satuan/master_satuan', compact('satuan'));
    }
}
