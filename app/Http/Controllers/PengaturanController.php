<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;

class PengaturanController extends Controller
{
    public function profil() {
        $email = Session::get('email');
        dd($email);
        return view('Pengaturan/profil', compact('email'));
    }
}
