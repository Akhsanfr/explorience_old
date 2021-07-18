<?php

namespace App\Http\Livewire\Show\Artikel;

use App\Models\Artikel;
use App\Models\Kuis;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ArtikelView extends Component
{

    public $artikel;
    public $slug;

    // Komentar input
    public $komentar_id; // get id parent of coment
    public $first_komen;
    public $second_komen;
    public $reply = 0 ; // get where is reply comment must open by look id parent comment

    public $komentar_second_id = null;
    public $komentar_second_nama = null;


    public function isSuccess(){
        return $this->success;
    }

    public function mount($slug){
        $this->slug;
        $this->artikel = Artikel::with('komentars')->where('slug', $slug)->first();
    }


    // First Komen
    public function saveFirstKomen(){
        $this->validate([
            'first_komen' => 'required',
        ]);
        Komentar::create([
            'id_parent' => 0,
            'komen' => $this->first_komen,
            'artikel_id' => $this->artikel->id,
            'user_id' => Auth::id(),
        ]);
        $this->first_komen = '';
        $this->artikel = Artikel::with('komentars')->where('slug', $this->slug)->first();
    }

    // Second Komen
    public function getParentId($id,$komentar_second_id = null ,$komentar_second_nama = null){
        $this->komentar_id = $id;
        $this->komentar_second_id = $komentar_second_id;
        if($komentar_second_nama){
            $this->komentar_second_nama = 'Reply comment for '.$komentar_second_nama;
        } else {
            $this->komentar_second_nama = '';
        }
        $this->reply = $id;
    }

    public function saveSecondKomen(){
        $this->validate([
            'second_komen' => 'required',
        ]);
        Komentar::create([
            'id_parent' => $this->komentar_id,
            'id_tag' => $this->komentar_second_id,
            'komen' => $this->second_komen,
            'artikel_id' => $this->artikel->id,
            'user_id' => Auth::id(),
        ]);
        $this->second_komen = '';
        $this->reply = 0;
        $this->artikel = Artikel::with('komentars')->where('slug', $this->slug)->first();
    }


    public function render()
    {
        return view('livewire.show.artikel.artikel-view')
                    ->extends('layouts/show');
    }
}

