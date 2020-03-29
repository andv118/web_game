<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\Ngocrong;
use App\Models\Slides;
use App\Models\Danhmuc;
use App\Models\UsersBuy;
use App\Models\UsersLog;
use App\Models\UsersService;
use App\Object\Game\GameNgocRong;
use Hash;
use Session;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BaseController extends Controller
{

    public function index()
    {
        $slideshows = [];
        $lienket = [];
        $giaodich = [];
        $danhmuc = Danhmuc::where('stt', 1)->get();
        $giaodich_data = UsersLog::where('trade_type', 5)->orderBy('id', 'desc')->take(20)->get();

        foreach ($giaodich_data as $value) {
            $user_id = $value->user_id;
            $user = $this->getUserInfo($user_id);
            $array = [
                'user_id' => $value->user_id,
                'user_name' => $user[0]['name'],
                'content' => $value->content,
                'amount' => $value->amount

            ];

            $giaodich[] = $array;
        }

        foreach ($danhmuc as $value) {
            if ($value->keyword == 'slideshow') {
                $slideshows = Slides::where('tt', 1)->get();
            }

            if ($value->keyword == 'websitelienket') {
                $lienket = ['active' => 1];
            }
        }

        return view('user/trangchu/index', compact('slideshows', 'lienket', 'giaodich'));
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('user/authentication/login');
    }

    public function register()
    {
        if (Auth::check()) {
            return redirect()->route('index');
        }
        return view('user/authentication/register');
    }


    public function nap_the()
    {
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }
        return view('user/napthe/index');
    }


    public function profile()
    {
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }
        return view('user/profile/index');
    }

    


   

    public function dich_vu_ngoc_rong()
    {
        
        return view('user/dichvu/ngocrong/index');
    }

   

    public function getUserInfo($uid)
    {

        $data = explode('_', $uid);
        if (count($data) == 2) {
            $user = Users::where('user_id', $data[1])->get()->toArray();
        } else {
            $user = Users::where('user_id', $uid)->get()->toArray();
        }

        if (count($user) > 0) {
            return $user;
        }
    }





    public function test()
    {
        $mytime = Carbon::now();
        echo $mytime->toDateTimeString();

        // dd($userLog);
    }
}
