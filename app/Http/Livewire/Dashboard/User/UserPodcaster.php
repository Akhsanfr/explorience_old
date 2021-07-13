<?php

namespace App\Http\Livewire\Dashboard\User;

use Livewire\Component;

class UserPodcaster extends Component
{
    public $podcasters;
    public function render()
    {
        $judul = 'Daftar Podcaster';
        return view('livewire.dashboard.user.user-podcaster')
                    ->extends('layouts.dashboard')
                    ->layoutData(compact('judul'));
    }
}
