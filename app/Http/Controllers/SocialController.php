<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator, Redirect, Response, File;
use Socialite;
use App\Models\Users;
use Auth;
use Hash;
use Session;

class SocialController extends Controller
{

    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }


    public function callback()
    {
        $getInfo = Socialite::driver('facebook')->user();
        // print_r($getInfo->user['name']);
        $user = $this->createUser($getInfo, 'facebook');
        //  auth()->login($user); 
        $check = array('user_id' => $getInfo->user['id'], 'password' => '123456');

        if (Auth::attempt($check)) {
            Session::put('user_id', Auth::user()->id . '_' . Auth::user()->user_id);
            return redirect()->route('index');
        }
    }


    function createUser($getInfo, $provider)
    {
        $user = Users::where('user_id', $getInfo->user['id'])->first();
        if (!$user) {
            $email = null;
            if(isset($getInfo->user['email']) && $getInfo->user['email'] != null ) {
                $email = $getInfo->user['email'];
            }
            $user = Users::create([
                'name'     => $getInfo->user['name'],
                'email'    => $email,
                'password' => bcrypt('123456'),
                'user_id' => $getInfo->user['id'],
                'user_agent' => $_SERVER["HTTP_USER_AGENT"],
                'last_time' => time()
            ]);
        }
    }
}
