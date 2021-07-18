<?php

namespace App\Http\Livewire\Dashboard\Kuis;

use App\Models\Kuis;
use Livewire\Component;


class KuisIndex extends Component
{
    // Get All Kuis
    public $kuises, $id_artikel;
    public $tambah = false;
    // Return id kuis saat kuis sedangn di edit
    public $edit = null;
    // Property kuis yang sedang di edit
    public $kuis, $id_kuis , $a, $b, $c, $d, $pertanyaan, $jawaban;

    public function mount($id){
        $this->id_artikel = $id;
        $this->kuises = Kuis::where('artikel_id', $id)->get();
    }

    public function tambah(){
        $this->tambah = true;
        $this->edit = false;
        $this->pertanyaan = '';
        $this->a = '';
        $this->b = '';
        $this->c = '';
        $this->d = '';
        $this->jawaban = '';
    }

    public function getKuis($id){
        // Ketika mode edit berjalan dan user menekan edit kuis yang lain, simpan perubahan kuis yang sebelumnya di edit
        if($this->edit != null){
            $this->simpan();
        }
        $this->tambah = false;
        $kuis = Kuis::find($id);
        $this->kuis = $kuis;
        $this->edit = $kuis->id;
        $this->id_kuis = $kuis->id;
        $this->a = $kuis->a;
        $this->b = $kuis->b;
        $this->c = $kuis->c;
        $this->d = $kuis->d;
        $this->pertanyaan = $kuis->pertanyaan;
        $this->jawaban = $kuis->jawaban;
    }

    public function simpan(){
        $this->validate([
            'pertanyaan' => 'required',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'jawaban' => 'required',
        ]);
        if($this->kuis == null){
            Kuis::create([
                'pertanyaan' => $this->pertanyaan,
                'a' => $this->a,
                'b' => $this->b,
                'c' => $this->c,
                'd' => $this->d,
                'jawaban' => $this->jawaban,
                'artikel_id' => $this->id_artikel,
            ]);
        } else {
            $this->kuis->pertanyaan = $this->pertanyaan;
            $this->kuis->a = $this->a;
            $this->kuis->b = $this->b;
            $this->kuis->c = $this->c;
            $this->kuis->d = $this->d;
            $this->kuis->jawaban = $this->jawaban;
            $this->kuis->save();
        }
        $this->kuis = null;
        $this->edit = null;
        $this->tambah = false;
        $this->kuises = Kuis::where('artikel_id', $this->id_artikel)->get();
    }

    public function cancel(){
        $this->edit = null;
        $this->tambah = false;
    }

    public function render()
    {
        $judul = 'Kuis';
        return view('livewire.dashboard.kuis.kuis-index')
                        ->extends('layouts.dashboard')
                        ->layoutData(compact('judul'));
    }
}
