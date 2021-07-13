<?php

namespace App\Http\Livewire\Dashboard\Artikel;

use App\Models\Artikel;
use Livewire\Component;

class ArtikelIndex extends Component
{
    public $artikels;
    public $artikel;

    public function getArtikel($id){
        $this->artikel = Artikel::find($id);
    }

    public function deleteArtikel(){
        $this->artikel->delete();
    }

    public function render()
    {
        $this->artikels = Artikel::with('writer','supervisor')->get();
        // $this->artikels = Artikel::all();
        $judul = 'Daftar Artikel';
        return view('livewire.dashboard.artikel.artikel-index')
                        ->extends('layouts.dashboard')
                        ->layoutData(compact('judul'));
    }
}
