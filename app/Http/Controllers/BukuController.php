<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Buku;
use App\Kategori;


class BukuController extends Controller
{
    public function index() {
    
    $buku = DB::table('table_buku')
    ->join('table_kategori', 'table_buku.kategori', '=', 'table_kategori.kategori')
    
    ->select('table_buku.id_buku','table_buku.judul_buku', 'table_buku.deskripsi', 
    'table_kategori.deskripsi as kategori', 'table_buku.cover_img')
    
    ->get();
    
    // return $buku;
    return view('buku.index', compact('buku'));
}
    
    public function create() {

    $kategori = Kategori::all();    
    
    return view('buku.create', compact('kategori'));
}
    
    public function store(Request $request) {
    
    $this->validate($request, [
    
    'judul_buku' => 'required',
    'deskripsi'  => 'required',
 ]);
    
    $file = $request->file('cover_img');
    $buku = new Buku;
    $buku->judul_buku = $request->judul_buku;
    $buku->deskripsi  = $request->deskripsi;
    $buku->kategori   = $request->kategori;
    $buku->cover_img  = $file->getClientOriginalName();
    $tujuan_upload = 'image';
    
            $file->move($tujuan_upload,$file->getClientOriginalName());
    
    $buku->save();

    return redirect('buku')->with('msg','Data Berhasil di Simpan');    
}
    public function show($id) {
    
    $buku = Buku::where('id_buku', $id)->first();
    
    return $buku;
 }  
    public function edit($id) {

}

    public function update(Request $request, $id) {
    
}

    public function destroy($id) {
    
   }
}