<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;

class ArtikelShowController extends Controller
{
    public function index(){
        $artikels = Artikel::where('is_active', 1)->latest()->get();
        $data = [];
        foreach($artikels as $index=>$artikel){
            $data[$index]['id'] = $artikel->id;
            $data[$index]['judul'] = $artikel->judul;
            $data[$index]['slug'] = $artikel->slug;
            $data[$index]['konten'] = $artikel->konten;
            $data[$index]['gambar'] = $artikel->gambar;
            $data[$index]['kategori'] = $artikel->kategori->nama;
            // $data[$index]['writer'] = $artikel->writer->nama;
            // $data[$index]['supervisor'] = $artikel->supervisor->nama;

        };
        return response()->json([
            'artikels' => $data,
        ], 200);
    }

    public function show($slug){
        $artikel = Artikel::where('slug', $slug)->first();
        $data = [];
        $data['id'] = $artikel->id;
        $data['judul'] = $artikel->judul;
        $data['slug'] = $artikel->slug;
        $data['konten'] = $artikel->konten;
        $data['gambar'] = $artikel->gambar;
        $data['kategori'] = $artikel->kategori->nama;
        $data['writer'] = $artikel->writer->nama;
        $data['supervisor'] = $artikel->supervisor->nama;

        return response()->json([
            'artikel' => $data,
        ]);
    }


}
