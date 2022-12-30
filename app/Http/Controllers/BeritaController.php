<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index(){
        $beritas = Berita::all();
        return view('back.berita.index',['beritas' => $beritas]);
    }

    public function create(){
        return view('back.berita.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'nid' => 'required|size:8|unique:beritas',
            'judul' => 'required|min:3|max:50',
            'summary' => '',
            'link' => '',
        ]);

        Berita::create($validateData);
        
        return redirect()->route('berita.index')->with(['sukses' => 'Data Berhasil tersimpan']);
    }

    public function image($id){
        $berita = Berita::find($id);
        return view('back.berita.image', ['berita' => $berita]);
    }

    public function upload(Request $request, $id){
        $berita = Berita::find($id);
        $request->validate([
            'berkas' => 'required|file|image|max:3000',
        ]);
        $extFile = $request->berkas->getClientOriginalName();
        $namaFile = $berita->nid.".png";
        $path = $request->berkas->storeAs('berita', $namaFile);
        return redirect()->route('berita.index')->with(['sukses' => 'Data Berhasil tersimpan']);
    }

    public function edit($id){
        $berita = Berita::find($id);
        return view('back.berita.edit', ['berita' => $berita]);
    }

    public function update(Request $request, $id){
        $berita = Berita::find($id);
        $validateData = $request->validate([
            'judul' => 'required|min:3|max:50',
            'summary' => '',
            'link' => '',
        ]);

        $berita->update($validateData);

        return redirect()->route('berita.index');
    }
}
