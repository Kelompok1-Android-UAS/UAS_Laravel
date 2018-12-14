<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function all(){
        $data['barang'] = \App\barang::all();

    	return view('barang.all')->with($data);
    }

    public function add(){
        $data['goedang'] = \App\gudang::all();
    	return view('barang.add')->with($data);
    }

    public function save(Request $r){
        $barang = new \App\barang;

        $barang->nama = $r->input('nama');
        $barang->berat = $r->input('berat');
        $barang->gudang_id = $r->input('gudang');
        $barang->save();


        return redirect()->route('semua_barang');
    }

    public function edit($id){
        $data['barang'] = \App\barang::find($id);
        $data['daftar_gudang'] = \App\gudang::all();

    	return view('barang.edit')->with($data);
    }

    public function update(Request $r){
        $edit_barang = \App\barang::find($r->input('id'));

        $edit_barang->nama = $r->input('nama');
        $edit_barang->berat = $r->input('berat');
        $edit_barang->gudang_id = $r->input('gudang');
        $edit_barang->save();


        return redirect()->route('semua_barang');
    }

    public function delete($id){
    	$hapus = \App\barang::findOrFail($id);
        $hapus->delete();   
        return redirect()->route('semua_barang');
    }
}
