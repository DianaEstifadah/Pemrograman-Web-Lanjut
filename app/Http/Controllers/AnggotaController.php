<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Anggota;

class AnggotaController extends Controller
{
    public function index() {

$anggota = Anggota::all();

return view('anggota.index', compact('anggota'));
}

public function create() {

return view('anggota.create');
}

public function store(Request $request) {

Anggota::create($request->all());

return redirect('anggota')->with('msg','Data Berhasil di Simpan');
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