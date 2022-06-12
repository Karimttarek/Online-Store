<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function index(){
        if(isset(Auth::user()->name)){

            $users = DB::table('users')->where('name' , Auth::user()->name)->select('name', 'email','firstname','lastname','image' , 'mobile' ,'address' , 'city' ,'country' ,'postalcode','aboutme')->get();
            foreach($users as $user){
                return view('site/profile', compact('user'));
            }
        }
        else {
            return redirect('/login');
        }
    }
}
