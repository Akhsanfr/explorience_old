<?php

namespace App\Http\Livewire\Dashboard\Kategori;

use App\Models\Artikel;
use App\Models\Kategori;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class KategoriIndex extends Component
{

    public $kategoris;
    public $nama, $nama_en, $kategori;
    protected $rules = [
        'nama' => 'required',
        'nama_en' => 'required',
    ];

    public function getKategori($id){
        $this->kategori = Kategori::find($id);
        $this->nama = $this->kategori->nama;
        $this->nama_en = $this->kategori->nama_en;
    }

    public function resetInput(){
        $this->nama = '';
        $this->nama_en = '';

    }
    public function cancel(){
        $this->resetInput();
    }


    public function store()
    {
        $this->validate();
        Kategori::create([
            'nama' => $this->nama,
            'nama_en' => $this->nama_en,
        ]);
        $this->resetInput();
    }

    public function update()
    {
        $this->validate();
        $this->kategori->update([
            'nama' => $this->nama,
            'nama_en' => $this->nama_en,
        ]);
        $this->resetInput();
    }

    public function delete(){
        $this->kategori->delete();
    }

    // KATEGORI ARTIKEL YANG BISA DITULIS WRITER

    public $writers = [];
    public $kategori_id;
    public $kategori_nama;

    public function getWriter(Kategori $kategori){
        $this->kategori = $kategori;
        $this->kategori_id = $kategori->id;
        $this->kategori_nama = $kategori->nama;
        // GET Users yang memiliki roles sebagai writer
        $this->writers = User::whereHas('roles',function (Builder $query){
            $query->where('roles.id','3');
        })->get();
    }

    public function toggleWriter($id){
        $this->kategori->users()->toggle($id);
    }

    public function render()
    {
        // $this->writers = Role::find(3)->users->pluck('nama','id')->all();
        $this->kategoris = Kategori::all();
        $judul = 'Halaman Kategori';
        return view('livewire.dashboard.kategori.kategori-index')
                ->extends('layouts.dashboard')
                ->layoutData(compact('judul'));
    }


}
