<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Komik;
use App\Models\Berita;
use App\Models\Profil;

class GuestController extends Controller
{
    public function index(){
        $komiks = DB::select("SELECT * FROM `komiks` ORDER BY updated_at DESC LIMIT 5 ");
        $beritas = DB::select("SELECT * FROM `beritas` ORDER BY updated_at DESC LIMIT 2 ");
        return view('front.layouts.home',['komiks' => $komiks, 'beritas' => $beritas]);
    }
    
    public function komik(){
        $komiks = Komik::all();
        return view('front.layouts.komik',['komiks' => $komiks]);
    }
    
    public function news(){
        $beritas = Berita::all();
        return view('front.layouts.news',['beritas' => $beritas]);
    }
    
    public function karakter(){
        $profil = Profil::all();
        return view ('front.layouts.character', [
            'profil' => $profil
        ]);
    }

    public function about(){
        return view('front.layouts.about');
    }

    public function show($id)
    {
        //
    }

    public function comiclist($id)
    {
        $komik = Komik::find($id);
        return view('front.layouts.comiclist',['komik' => $komik]);
    }

    public function detail($slug){
        $profil = Profil::where('slug', $slug)->first();

        return view('front.layouts.profil-karakter', [
            'profil' => $profil
        ]);
    }
}
