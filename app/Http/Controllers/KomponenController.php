<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Komponen;
use Illuminate\Support\Facades\DB;
use App\KomponenOpsi;
use App\Satuan;
use Log;


class KomponenController extends Controller
{
    public function komponen(){

        $komponen = Komponen::with('satuan')->where('id_parent')->get();
        // foreach($komponen as $val){
        //     dd($val->satuan->nama);
        // }
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
        // Log::info($request); 
        
        DB::beginTransaction();
         $data = new Komponen;     
         $data->nama = $request->nama;
         $data->id_parent = $data->id;
         $data->id_satuan = $request->id_satuan;
         $data->bobot = $request->bobot;
         $data->save();
         
        if(isset($input['ops'])){
            foreach ($input['ops'] as $key => $value) {
                $opsi = new KomponenOpsi;
                $opsi->opsi = $value;                    
                $opsi->id_komponen = $data->id;
                $opsi->nilai = $input['nilai'][$key];
                $opsi->save();    
            }
        }

        array_pop($input['nama2']);
        $i_opsikop = 0;
        foreach ($input['nama2'] as $key => $value) {
            if ($value){               
               $data2 = new Komponen;
               $data2->nama = $value;
               $data2->id_parent = $data->id;
               $data2->id_satuan = $input['satuan2'][$key];
               $data2->bobot = $input['bobot2'][$key];
               $data2->save();

                if(isset($input['opsikomp'])){
                    $itungan = 1;
                    for($i_opsikop; count($input['opsikomp']) > $i_opsikop ; $i_opsikop++){
                        if($itungan <= 6){
                            $opsi = new KomponenOpsi;
                            $opsi->opsi = $input['opsikomp'][$i_opsikop][0];                    
                            $opsi->id_komponen = $data2->id;
                            $opsi->nilai = $input['nilai'][$i_opsikop][0];                           
                            $opsi->save();  
                            $itungan++;  
                        } else {
                            break;
                        }
                    }
                }
            }
                        
        }
        DB::commit();
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
        if(isset($input['nama2'])){
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
        
        }
        return redirect('masterkomponen');
    }

    function delete(Request $request) {
        $delete = Komponen::find($request->id);
        $delete->delete();
        return redirect('masterkomponen');
    }

    public function detail($id){

        $detail = Komponen::with('satuan')->where('id_parent','=', $id)->get();
        $detail1 = Komponen::find($id);
        return view('Komponen/detail_komponen',compact('detail','detail1'));
    }

     
}