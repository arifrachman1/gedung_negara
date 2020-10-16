<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komponen;
use App\Satuan;

class KomponenController extends Controller
{
    public function komponen(){

        $komponen = Komponen::select('*')->where('id_parent')->get();
        $satuan = Satuan::get();
        return view('Komponen/master_komponen', compact('satuan','komponen'));
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
        $subkomponen = Komponen::where(['id_parent' => $id])->get();
        return view('Komponen/edit_komponen', compact('komponen','satuan', 'subkomponen'));
    }    
     
    public function update(Request $request, $id)
    {
        $input = $request->all();
        // dd($input['nama2']);

        $update = Komponen::find($id);        
        $update->nama = $request->nama;
        $update->id_satuan = $request->id_satuan;
        $update->bobot = $request->bobot;
        $update->save();
        $komp = Komponen::where('id_parent',$id)->delete();        
        foreach ($input['nama2'] as $key => $value) {
            if ($value){
               $data2 = new Komponen;
               $data2->nama = $value;
               $data2->id_parent = $update->id;
               $data2->id_satuan = $input['satuan2'][$key];
               $data2->bobot = $input['bobots'][$key];
               $data2->save();
            }
        }
        return redirect('masterkomponen');
    }

    function delete($id) {
        $delete = Komponen::find($id);
        $delete->delete($id);
        return redirect('masterkomponen');
    }

    public function detail($id){

        $detail = Komponen::select('*')->where('id_parent','=', $id)->get();
        $detail1 = Komponen::find($id);
        return view('Komponen/detail_komponen',compact('detail','detail1'));
    }

     
}