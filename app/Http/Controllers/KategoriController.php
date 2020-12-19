<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Kategori;

class KategoriController extends Controller
{
    public function index() {

     $kategori = Kategori::all();

     // return $kategori;

     // return view('kategori.index', compact('kategori'));
return view('kategori/index', compact('kategori'));
}

public function create() {

return view('kategori.create');
}

public function store(Request $request) {

Kategori::create($request->all());

return redirect('kategori')->with('msg','Data Berhasil di Simpan');
}

public function show($id) {

}

public function edit($id) {

}

public function update(Request $request, $id) {

}

public function destroy($id) {

   }
}