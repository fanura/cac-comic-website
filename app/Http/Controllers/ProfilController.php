<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use App\Models\Karakter;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profil::all();
        return view('back.profil.index', [
            'profil' => $profil
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
        return view('back.profil.create', compact('karakter'));
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
            'nama_karakter' => 'required|min:1',
            
            ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->nama_karakter);
        $data['gambar_karakter'] = $request->file('gambar_karakter')->store('profil');
        
        Profil::create($data);
        

            return redirect()->route('profil.index')->with(['sukses' => 'Data Berhasil tersimpan']);
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
        $profil = Profil::find($id);
        $karakter = Karakter::all();

        return view('back.profil.edit', [
            'profil' => $profil,
            'karakter' => $karakter,
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
        if(empty($request->file('gambar_karakter'))){

            $profil = Profil::find($id);
            $profil->update([
            'nama_karakter' => $request->nama_karakter,
            'slug' => Str::slug($request->nama_karakter),
            'nama_asli' => $request->nama_asli,
            'asal' => $request->asal,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'kemampuan' => $request->kemampuan,
            'latar_belakang' => $request->latar_belakang,
            'is_active' => $request->is_active,

            ]);

            return redirect()->route('profil.index')->with(['sukses' => 'Data Berhasil tersimpan']);
           
            
        } else {
            $profil = Profil::find($id);
            Storage::delete($profil->gambar_karakter);
            $profil->update([
            'nama_karakter' => $request->nama_karakter,
            'gambar_karakter' => $request->file('gambar_karakter')->store('profil'),
            'slug' => Str::slug($request->nama_karakter),
            'nama_asli' => $request->nama_asli,
            'asal' => $request->asal,
            'tinggi' => $request->tinggi,
            'berat' => $request->berat,
            'kemampuan' => $request->kemampuan,
            'latar_belakang' => $request->latar_belakang,
            'is_active' => $request->is_active,

            ]);
            return redirect()->route('profil.index')->with(['sukses' => 'Data Berhasil tersimpan']);
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
        $profil = Profil::find($id);

        Storage::delete('$profil->gambar_karakter');
        $profil->delete();

        return redirect()->route('profil.index')->with(['sukses' => 'Data Berhasil Dihapus']);
    }
}
