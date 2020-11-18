<?php

namespace App\Http\Controllers;

use App\Gedung;
use App\User;
use App\Kerusakan;
use App\KategoriGedung;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //class HomeController extends Controller

    public function index()
    {
        $user = User::count();
        $jenis = KategoriGedung::count();
        $gedung = Gedung::count();
        $kerusakan = Kerusakan::count();
        return view('dashboard',compact('gedung','user','jenis','kerusakan'));
    }
}
