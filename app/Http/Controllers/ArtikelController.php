<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $artikels = Artikel::all();
        // $judul = 'Daftar Artikel';
        // return view('controller.artikel.index', compact('artikels', 'judul'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $type = 'create';
        $judul = "Tulis Artikel Baru";
        return view('controller.artikel.create', compact('judul', 'type', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|file|image',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $pathGambar = $request->gambar->store('artikel');
        $validated += ['slug' => Str::slug($request->judul, '-')];
        $validated += ['writer_id' => Auth::id()];
        $validated['gambar'] = $pathGambar;
        Artikel::create($validated);
        return redirect(route('artikel-index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        $judul = "Tulis Artikel Baru";
        return view('controller.artikel.show', compact('artikel','judul'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Artikel $artikel)
    {
        $kategoris = Kategori::all();
        $type = 'edit';
        $judul = "Edit Artikel $artikel->judul ";
        return view('controller.artikel.create', compact('judul', 'type', 'artikel', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artikel $artikel)
    {
        $validated = $request->validate([
            'judul' => 'required',
            'konten' => 'required',
            'gambar' => 'required|file|image',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);
        Storage::delete($artikel->gambar);
        $pathGambar = $request->gambar->store('artikel');
        $validated += ['slug' => Str::slug($request->judul, '-')];
        $validated += ['writer_id' => Auth::id()];
        $validated['gambar'] = $pathGambar;
        $artikel->update($validated);
        return redirect(route('artikel-index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function ubahStatus(Artikel $artikel){
        if($artikel->is_active){
            $artikel->supervisor_id = null;
        }
        $artikel->is_active = !$artikel->is_active;
        $artikel->supervisor_id = Auth::id();
        $artikel->save();
        return redirect(route('artikel-index'));
    }
}
