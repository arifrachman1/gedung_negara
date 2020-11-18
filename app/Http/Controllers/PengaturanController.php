<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;

class PengaturanController extends Controller
{
    public function profil() {
        $name = Session::get('name');
        $profile = User::where('name', $name)->first();
        return view('Pengaturan/profil', compact('profile'));
    }

    public function pengaturan() {
        $name = Session::get('name');
        $user = User::where('name', $name)->first();
        return view('Pengaturan/pengaturankw', compact('user'));
    }

    public function updatePwd($id, Request $request) {
        $data = User::find($id);
        $password = $data->password;
        if(password_verify($request->old_pwd, $password)) {
            $data->password = bcrypt($request->new_pwd);
            $data->update();
            return "<script>alert('Kata sandi telah diperbarui');</script>".redirect('profil');
        } else {
            return redirect('pengaturan')->with('alert', 'Kata sandi lama salah!');
        }
        
    } 
}
