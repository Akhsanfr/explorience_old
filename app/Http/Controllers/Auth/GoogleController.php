<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    public function login(){
        return Socialite::driver('google')->redirect();
    }

    public function callback(){
        $user = Socialite::driver('google')->user();
        $google_id = $user->getId();
        $user_lama = User::where('google_id', $google_id)->first();
        if($user_lama){
            $data= [
                'nama' => Str::title($user->getName()),
                'email' => $user->getEmail(),
                'google_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
            ];
            $user_lama->update($data);
            Auth::login($user_lama);
            return redirect(route('welcome'));
        } else {
            $user_baru = [
                'nama' => Str::title($user->getName()),
                'email' => $user->getEmail(),
                'google_id' => $user->getId(),
                'avatar' => $user->getAvatar(),
            ];
            $user = User::create($user_baru);
            Auth::login($user);
            return redirect(route('welcome'));
        }
    }
}
