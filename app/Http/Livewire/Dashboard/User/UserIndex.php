<?php

namespace App\Http\Livewire\Dashboard\User;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserIndex extends Component
{
    use AuthorizesRequests;
    public $auth_user, $judul;
    public $users, $user;
    public $admin, $supervisor, $writer, $podcaster;

    public function getUser($id){
        $user = User::find($id);
        $this->user = $user;
    }

    public function getUserRole($id, $roles){
        $this->getUser($id);
        $this->admin = false;
        $this->supervisor = false;
        $this->writer = false;
        $this->podcaster = false;
        foreach($roles as $role){
            if($role['nama'] == 'admin'){
                $this->admin = true;
            } elseif($role['nama'] == 'supervisor') {
                $this->supervisor = true;
            } elseif($role['nama'] == 'writer') {
                $this->writer = true;
            } elseif($role['nama'] == 'podcaster') {
                $this->podcaster = true;
            }
        }
    }

    public function updateStatus(){
        $this->authorize('update', User::class);
        $this->user->is_active = !$this->user->is_active;
        $this->user->save();
    }

    public function deleteUser(){
        $this->authorize('delete', User::class);
        $this->user->delete();
    }

    public function role(){
        $this->authorize('update', User::class);
        $this->user->roles()->detach();
        $this->admin ? $this->user->roles()->attach(1) : $this->user->roles()->detach(1);
        $this->supervisor ? $this->user->roles()->attach(2) : $this->user->roles()->detach(2);
        $this->writer ? $this->user->roles()->attach(3) : $this->user->roles()->detach(3);
        $this->podcaster ? $this->user->roles()->attach(4) : $this->user->roles()->detach(4);
    }

    public function render()
    {
        $judul = 'Daftar Team Explorience';
        $this->users = User::with('roles')->get();
        return view('livewire.dashboard.user.user-index')
                    ->extends('layouts.dashboard')
                    ->layoutData(compact('judul'));
    }
}
