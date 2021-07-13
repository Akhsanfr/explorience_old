<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Welcome extends Component
{
    public function render()
    {
        $judul = 'Selamat datang';
        return view('livewire.dashboard.welcome')
                    ->extends('layouts.dashboard')
                    ->layoutData(compact('judul'))
                    ;
    }
}
