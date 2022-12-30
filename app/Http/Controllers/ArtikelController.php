<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Karakter;
use finfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\VarDumper\Cloner\Data;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::all();
        return view('back.artikel.index', [
            'artikel' => $artikel
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $karakter = Karakter::all();
        return view('back.artikel.create', compact('karakter'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|min:4',
            ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->judul);
        $data['views'] =0;
        $data['gambar_artikel'] = $request->file('gambar_artikel')->store('artikel');
        
        Artikel::create($data);
        

            return redirect()->route('artikel.index')->with(['sukses' => 'Data Berhasil tersimpan']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $artikel = Artikel::find($id);

        return view('back.artikel.edit', [
            'artikel' => $artikel
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*$this->validate($request, [
            'judul' => 'required|min:4',
        ]);*/

        if(empty($request->file('gambar_artikel'))){

            $artikel = Artikel::find($id);
            $artikel->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'body' => $request->body,
            'is_active' => $request->is_active,
            'views' => 0,
            ]);

            return redirect()->route('artikel.index')->with(['sukses' => 'Data Berhasil tersimpan']);
           
            
        } else {
            $artikel = Artikel::find($id);
            Storage::delete($artikel->gambar_artikel);
            $artikel->update([
            'judul' => $request->judul,
            'slug' => Str::slug($request->judul),
            'body' => $request->body,
            'is_active' => $request->is_active,
            'views' => 0,
            'gambar_artikel' => $request->file('gambar_artikel')->store('artikel'),
            ]);
            return redirect()->route('artikel.index')->with(['sukses' => 'Data Berhasil tersimpan']);
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $artikel = Artikel::find($id);

        Storage::delete('$artikel->gambar_artikel');
        $artikel->delete();

        return redirect()->route('artikel.index')->with(['sukses' => 'Data Berhasil Dihapus']);
    }
}
