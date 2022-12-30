<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Komik;
use Illuminate\Support\Str;

class KomikController extends Controller
{
    public function index(){
        $komiks = Komik::all();
        return view('back.komik.index',['komiks' => $komiks]);
    }

    public function create(){
        return view('back.komik.create');
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'cid' => 'required|size:8|unique:komiks',
            'name' => 'required|min:3|max:50',
            'volume' => 'required',
            'publish' => 'required',
            'summary' => '',
            'link' => '',
        ]);

        Komik::create($validateData);
        
        return redirect()->route('komik.index')->with(['sukses' => 'Data Berhasil tersimpan']);
    }

    public function image($id){
        $komik = Komik::find($id);
        return view('back.komik.image', ['komik' => $komik]);
    }

    public function upload(Request $request, $id){
        $komik = Komik::find($id);
        $request->validate([
            'berkas' => 'required|file|image|max:3000',
        ]);
        $extFile = $request->berkas->getClientOriginalName();
        $namaFile = $komik->cid.".png";
        $path = $request->berkas->storeAs('public/komik', $namaFile);
        return redirect()->route('komik.index')->with(['sukses' => 'Data Berhasil tersimpan']);
    }

    public function edit($id){
        $komik = Komik::find($id);
        return view('back.komik.edit', ['komik' => $komik]);
    }

    public function update(Request $request, $id){
        $komik = Komik::find($id);
        $validateData = $request->validate([
            'name' => 'required|min:3|max:50',
            'volume' => 'required',
            'publish' => 'required',
            'summary' => '',
            'link' => '',
        ]);

        $komik->update($validateData);

        return redirect()->route('komik.index');
    }
}
