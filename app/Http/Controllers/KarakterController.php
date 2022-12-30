<?php

namespace App\Http\Controllers;

use App\Models\Karakter;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KarakterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $karakter = Karakter::all();
        return view('back.karakter.index', compact('karakter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.karakter.create');
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
            'jenis_karakter' => 'required|min:2',
        ]);

        $karakter = Karakter::create([
            'jenis_karakter' => $request->jenis_karakter,
            'slug' => Str::slug($request->jenis_karakter)
        ]);

            return redirect()->route('karakter.index')->with(['sukses' => 'Data Berhasil tersimpan']);

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
        $karakter = Karakter::find($id);

        return view('back.karakter.edit', compact('karakter'));
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
        $data = $request->all();
        $data['slug'] = Str::slug($request->jenis_karakter);

        $karakter = Karakter::findOrFail($id);
        $karakter->update($data);

        return redirect()->route('karakter.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $karakter = Karakter::find($id);

        $karakter->delete();

        return redirect()->route('karakter.index')->with(['sukses' => 'Data Berhasil Dihapus']);
    }
}
