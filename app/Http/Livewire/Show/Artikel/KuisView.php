<?php

namespace App\Http\Livewire\Show\Artikel;

use App\Models\Kuis;
use Livewire\Component;

class KuisView extends Component
{
    // Get All Kuis
    public $kuises;
    public $kunci_jawaban;
    public $jumlah_kuis;

    // Store pilihan jawaban user
    public $history_jawaban = [];

    // Kuis yang sedang dijalankan
    public $kuis;
    public $index_kuis;

    // Store model pilihan jawaban user
    public $jawaban;

    // Show score
    public $nilai;

    public function mount($id){
        $this->kuises = Kuis::where('artikel_id', $id)->get();
        $this->kunci_jawaban = $this->kuises->pluck('jawaban');
        $this->jumlah_kuis = $this->kuises->count();
        // Start Kuis
        $this->index_kuis = 0;
        $this->kuis = $this->kuises[$this->index_kuis];
    }

    public function tambahJawaban(){
        $this->history_jawaban[$this->index_kuis] = $this->jawaban;
    }

    public function prevQuestion(){
        $this->tambahJawaban();
        $this->index_kuis -= 1;
        $this->kuis = $this->kuises[$this->index_kuis];
        if(isset($this->history_jawaban[$this->index_kuis])){
            $this->jawaban = $this->history_jawaban[$this->index_kuis];
        } else {
            $this->jawaban = null;
        }
    }

    public function nextQuestion(){
        $this->tambahJawaban();
        $this->index_kuis += 1;
        $this->kuis = $this->kuises[$this->index_kuis];
        if(isset($this->history_jawaban[$this->index_kuis])){
            $this->jawaban = $this->history_jawaban[$this->index_kuis];
        } else {
            $this->jawaban = null;
        }
    }

    public function submit(){
        $nilai = 0;
        foreach($this->kunci_jawaban as $index => $kunci){
            if($kunci == $this->history_jawaban[$index]){
                $nilai += 1;
            }
        }
        $this->nilai = $nilai;
    }

    public function render()
    {
        return view('livewire.show.artikel.kuis-view')
        ->extends('layouts/show');
    }
}
