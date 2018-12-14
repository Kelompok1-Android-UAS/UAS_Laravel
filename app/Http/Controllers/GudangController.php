<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use \App\gudang;

class GudangController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function all(){
        $data['gudang'] = \App\gudang::all();

    	return view('gudang.all')->with($data);
    }

    public function add(){
    	return view('gudang.add');
    }

    public function save(Request $r){
        $gdg = new gudang;
        $gdg->alamat = $r->input('alamat');
        $gdg->kapasitas = $r->input('kapasitas');

        $foto = $r->file("foto");
        $nama_foto = $foto->getClientOriginalName();
        $r->file('foto')->move("uploads/img/", $nama_foto);

        $gdg->pic = $nama_foto;

        $gdg->save();


        return redirect()->route('semua_gudang');
    }

    public function edit($id){
        $data['gudang'] = \App\gudang::find($id);

    	return view('gudang.edit')->with($data);
    }

    public function update(Request $r){
        $edit_gudang = gudang::find($r->input('id'));

        $edit_gudang->alamat = $r->input('alamat');
        $edit_gudang->kapasitas = $r->input('kapasitas');

        $foto = $r->file("foto");
        echo $foto->getClientOriginalName();

        // if ($foto != ''){
        //     $nama_foto = $foto->getClientOriginalName();
        //     $r->file('foto')->move("uploads/img/", $nama_foto);
        //     $edit_gudang->pic = $nama_foto;
        // }

        // $edit_gudang->save();
        // return redirect()->route('semua_gudang');
    }

    public function delete($id){
    	$hapus = gudang::findOrFail($id);
        $path_foto = app_path("../public/uploads/img/{{$hapus->pic}}");
        Storage::delete($path_foto);    
        $hapus->delete();   
        return redirect()->route('semua_gudang');
    }
}
