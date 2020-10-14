<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komponen;

class KomponenController extends Controller
{
    public function komponen(){

        $komponen = Komponen::get();
        return view('Komponen/master_komponen',compact('komponen'));
    }
}
