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
    public function inputSatuan() {
        $satuan = Satuan::get();
        return view('satuan/tambah_satuan', compact('satuan'));
    }

    public function inputSatuanPost(Request $request) {
        $input = new Satuan;
        $input->nama = $request->nama;
        $input->save();
        return redirect('mastersatuan');
    }

    public function edit($id) {
        $edit = Satuan::find($id);
        return view('satuan/edit_satuan', compact('edit'));
    }

    public function editSatuanPost($id, Request $request) 
    {
        $update = Satuan::find($id);
        $update->nama = $request->nama;
        $update->update();
        
        return redirect('mastersatuan');
    }

    public function delete(Request $request)
    {
        $delete = Satuan::find($request->id);
        $delete->delete();
        return redirect('mastersatuan');
    }

}
