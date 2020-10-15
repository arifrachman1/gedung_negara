<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komponen;
use App\Satuan;

class KomponenController extends Controller
{
    public function komponen(){

        $komponen = Komponen::whereNull('id_parent')->get();
        return view('Komponen/master_komponen',['komponen' => $komponen]);
    }
    public function addKomponen() {
        $satuan = Satuan::get();
        $komponen = Komponen::get();
        return view('Komponen/tambah_komponenkw', compact('satuan','komponen'));
    }

    public function Add(Request $request){
        $input = $request->all();
        // dd($input); 
        
         $data = new Komponen;     
         $data->nama = $request->nama;
         $data->id_parent = $data->id;
         $data->id_satuan = $request->id_satuan;
         $data->bobot = $request->bobot;
         $data->save();
         
         foreach ($input['nama2'] as $key => $value) {
             if ($value){
                $data2 = new Komponen;
                $data2->nama = $value;
                $data2->id_parent = $data->id;
                $data2->id_satuan = $input['satuan2'][$key];
                $data2->bobot = $input['bobot'];
                $data2->save();
             }
                         
         }
    return redirect('masterkomponen');
    }

    public function edit($id) {
        $satuan = Satuan::get();
        $komponen = Komponen::find($id);
        return view('Komponen/edit_komponen', compact('komponen','satuan'));
    }    
     
    public function update(Request $request)
    {
        $input = $request->all();
        dd($input); 
        $input = $this->validate($request, [
            'nama' => 'required',
            'id_satuan' => 'required'
        ]);
        $update = Komponen::find($request->id);
        $update->nama = $request->nama;
        $update->id_satuan = $request->id_satuan;
        $update->save();

        return redirect('masterkomponen');
    }

     
}