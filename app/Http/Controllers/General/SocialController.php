<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    //
    public function redirect($service){

        return Socialite::driver($service)->redirect();
    }

    public function callback($service){

        return $user = Socialite::with($service)->user();
    }

}
