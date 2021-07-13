<?php

namespace App\Http\Livewire\Dashboard\Komentar;

use App\Models\Komentar;
use Livewire\Component;

class KomentarIndex extends Component
{
    public $komentars, $komentar, $komentar_is_active;

    public function getKomentar($id){
        $this->komentar = Komentar::find($id);
        $this->komentar_is_active = $this->komentar->is_active;
    }

    public function updateStatus(){
        $this->komentar->is_active = !$this->komentar->is_active;
        $this->komentar->save();

    }

    public function render()
    {
        $judul = 'Komentar';
        $this->komentars = Komentar::with('user')->get();
        return view('livewire.dashboard.komentar.komentar-index')
                        ->extends('layouts.dashboard')
                        ->layoutData(compact('judul'));
    }
}
