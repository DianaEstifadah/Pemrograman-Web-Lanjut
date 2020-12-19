<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use App\Buku;
use App\Kategori;
use App\Anggota;
use App\Transaksi;

class TransaksiController extends Controller
{
    public function index(){
    
    $transaksi = DB::table('table_transaksi')

    ->join('table_buku', 'table_buku.id_buku', '=', 'table_transaksi.id_buku')
    ->join('table_kategori', 'table_kategori.kategori', '=', 'table_buku.kategori')
    ->join('table_anggota', 'table_transaksi.id_anggota', '=', 'table_anggota.id_anggota')
    
    ->select('table_transaksi.id','table_anggota.nama_anggota','table_buku.id_buku',
    
    'table_buku.judul_buku', 
    'table_buku.deskripsi', 'table_kategori.deskripsi as kategori',
    'table_transaksi.tgl_pinjam','table_transaksi.tgl_kembali')
    
    ->get();
    
    // return $transaksi;
    
    return view('transaksi.index', compact('transaksi'));
    }
    
    public function create(){
    
    return view('transaksi.pinjam');
    }
    
    public function store(Request $request){
    
    if(Anggota::where('id_anggota', $request->id_anggota)->count() > 0){
    
    if(Buku::where('id_buku', $request->id_buku)->count() > 0){
    
    // return $request;
    
    $transaksi = new Transaksi;
    
    // $transaksi->type_transaksi = $request->type_transaksi;
    
    $transaksi->id_anggota = $request->id_anggota;
    
    $transaksi->id_buku = $request->id_buku;
    
    if($request->type_transaksi == 'pinjam'){
    
    $transaksi->tgl_pinjam = $request->tgl_pinjam;
    $transaksi->tgl_kembali = null;
    $transaksi->save();
    
    return redirect('transaksi')->with('msg','Data Berhasil di Simpan');
    }else{
    
    $transaksi->tgl_kembali = $request->tgl_kembali;
    }
    
    // return $transaksi;
    
    }else{
    
    return json_encode('Buku tidak ditemukan!');
    }
    
    }else{
    
    return json_encode('Anggota tidak ditemukan');
      }
    }
    
    public function show($id){
    
    $pinjaman = DB::table('table_transaksi')
    
    ->join('table_buku', 'table_buku.id_buku', '=', 'table_transaksi.id_buku')
    ->join('table_anggota', 'table_anggota.id_anggota', '=', 'table_transaksi.id_anggota')
    ->join('table_kategori', 'table_kategori.kategori', '=', 'table_buku.kategori')
    
    ->select('table_transaksi.id','table_transaksi.id_anggota', 'table_anggota.nama_anggota',
    
    'table_buku.id_buku', 'table_buku.judul_buku','table_buku.deskripsi',
    'table_kategori.deskripsi as kategori','table_transaksi.tgl_pinjam',
    'table_transaksi.tgl_kembali')
    
    ->where('table_transaksi.id', '=', $id)->first();
    
    return json_encode($pinjaman);
    }
    
    public function showBuku($id) {
    
    // $buku = Buku::where('id_buku', $id)->first();
    
    if(Buku::where('id_buku', $id)->count() > 0){
    
    $buku = DB::table('table_buku')
    
    ->join('table_kategori', 'table_buku.kategori', '=', 'table_kategori.kategori')
    
    ->select('table_buku.id_buku','table_buku.judul_buku', 'table_buku.deskripsi', 
    'table_kategori.deskripsi as kategori', 'table_buku.cover_img')
    
    ->where('table_buku.id_buku', '=', $id)
    
    ->get();
    
    return $buku;
    
    }else{
    
    return 'false';
    }
 }
        
    public function getAnggota($id) {

    // $buku = Buku::where('id_buku', $id)->first();
    $anggota = Anggota::where('id_anggota', $id)->first();
    
    // return $anggota;
    
    if($anggota === null){
    
    return 'false';
    
    }else{
    
    return $anggota;
    }
}
    
    public function edit($id) {
    
    $pinjaman = DB::table('table_transaksi')
    
    ->join('table_buku', 'table_buku.id_buku', '=', 'table_transaksi.id_buku')
    ->join('table_anggota', 'table_anggota.id_anggota', '=', 'table_transaksi.id_anggota')
    ->join('table_kategori', 'table_kategori.kategori', '=', 'table_buku.kategori')
    
    ->select('table_transaksi.id','table_transaksi.id_anggota', 'table_anggota.nama_anggota',
    'table_buku.id_buku', 'table_buku.judul_buku','table_buku.deskripsi',
    'table_kategori.deskripsi as kategori','table_transaksi.tgl_pinjam',
    'table_transaksi.tgl_kembali')
    
    ->where('table_transaksi.id', '=', $id)->first();
    
    return view('transaksi.kembali', compact('pinjaman'));
    }
    
    public function update(Request $request, $id) {
    
    Transaksi::where('id',$id)
    
    ->update(['tgl_kembali' => $request->tgl_kembali]);
    
    return redirect('transaksi')->with('msg','Buku Telah dikembalikan');
    }
    
    public function destroy($id) {
    
    }
}