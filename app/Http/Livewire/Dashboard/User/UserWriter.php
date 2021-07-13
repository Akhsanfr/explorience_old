<?php

namespace App\Http\Livewire\Dashboard\User;

use App\Models\Kategori;
use Livewire\Component;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserWriter extends Component
{
    public $writers;
    public $kategoris =[], $writer, $writer_nama, $writer_id;

    public function getWriter(User $writer){
        $this->kategoris = Kategori::all();
        $this->writer = $writer;
        $this->writer_nama = $writer->nama;
        $this->writer_id = $writer->id;
    }

    public function toggleWriter($id){
        $this->writer->kategoris()->toggle($id);
    }

    public function render()
    {
        $this->writers = User::with('kategoris')
                        ->withCount(['artikels','artikels as artikels_active' => function(Builder $query){
                            $query->where('is_active', true);
                        }])->whereHas('roles',function (Builder $query){
                            $query->where('roles.id','3');
                        })->orderBy('nama')->get();
        $judul = 'Daftar Writer';
        return view('livewire.dashboard.user.user-writer')
                    ->extends('layouts.dashboard')
                    ->layoutData(compact('judul'));
    }
}
