<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class TopBar extends Component
{
    public $user, $judul;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.top-bar');
    }
}
