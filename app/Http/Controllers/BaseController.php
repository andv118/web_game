<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\Ngocrong;
use App\Models\Slides;
use App\Models\Danhmuc;
use App\Models\UsersBuy;
use App\Models\UsersLog;
use Hash;
use Session;
use Auth;
use Carbon\Carbon;

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

    public function ngoc_rong($param, Request $request)
    {
        $pagination = 20;
        $keyword  = $request->input('keyword');
        $id       = $request->input('id');
        $status   = $request->input('status');
        $bongtai  = $request->input('bongtai');
        $detu     = $request->input('detu');
        $hanhtinh = $request->input('hanhtinh');
        $server   = $request->input('servers');
        $dangky   = $request->input('dangky');
        $price    = $request->input('price');

        $price1 = $this->progressPrice($price)['price1'];
        $price2 = $this->progressPrice($price)['price2'];

        if ($param == 'all') {
            $title = "Tài khoản ngọc rồng";
        } elseif ($param == 'tam-trung') {
            $title = "Nick ngọc rồng tầm trung";
            $price1 = 0;
            $price2 = 300000;
        } else {
            return redirect()->route('index');
        }

        $data = Ngocrong::query()
            ->note($keyword)
            ->id($id)
            ->price($price1, $price2)
            ->status($status)
            ->bongtai($bongtai)
            ->detu($detu)
            ->hanhtinh($hanhtinh)
            ->server($server)
            ->dangky($dangky)
            ->orderBy('date', 'desc')
            ->paginate($pagination);
        // dd($data);
        // luu session old    
        session()->flashInput($request->input());
        return view('user/ngocrong/index', compact('data', 'title'));
    }

    /**
     * Xử lý việc chọn giá cả
     * @param int
     * @return array
     */
    public function progressPrice($price)
    {
        $price1 = null;
        $price2 = null;
        switch ($price) {
            case 1:
                $price1 = 0;
                $price2 = 50000;
                break;
            case 2:
                $price1 = 50000;
                $price2 = 200000;
                break;
            case 3:
                $price1 = 200000;
                $price2 = 500000;
                break;
            case 4:
                $price1 = 500000;
                $price2 = 1000000;
                break;
            case 5:
                $price1 = 1000000;
                break;
            case 6:
                $price1 = 2000000;
                break;
            case 7:
                $price1 = 5000000;
                break;
        }
        return [
            'price1' => $price1,
            'price2' => $price2,
        ];
    }

    public function chi_tiet_ngoc_rong($id)
    {
        if (isset($id)) {
            $data = Ngocrong::where('id', $id)
                ->where('type', 0)
                ->get();
            if (count($data) > 0) {
                $data2 = Ngocrong::where('id', '<>', $id)->where('status', 0)->inRandomOrder()->take(8)->get();
                return view('user/chitietngocrong/index', compact('data', 'data2'));
            } else {
                return redirect()->route('index');
            }
        }
    }

    public function dich_vu_ngoc_rong()
    {

        return view('user/dichvu/ngocrong/index');
    }

    public function thanh_toan_ngoc_rong(Request $request)
    {
        // dd($request->input());
        $id = $request->input('id');
        $cost = $request->input('cost');
        if ($cost > Auth::user()->cash) {
            return redirect()->back()->with('error', 'Tài khoản không đủ tiền để thực hiện giao dịch');
        } elseif (Auth::user()->locked == 1) {
            return redirect()->back()->with('error', 'Tài khoản của bạn đã bị chặn giao dịch');
        } else {
            $data = Ngocrong::where('id', $id)->get()->toArray();

            Ngocrong::where('id', $id)->update(['status' => 1]);

            $cash = Auth::user()->cash - (int) $data[0]['cost'];

            Users::where('user_id', Auth::user()->user_id)->update(['cash' => $cash]);

            $log = new UsersLog();
            $log->user_id = Auth::user()->user_id;
            $log->trade_type = 5;
            $log->amount = $data[0]['cost'];
            $log->content = 'Mua tài khoản Ngọc Rồng' . ' #' . $id;
            $log->last_amount = $cash;
            $log->status = 1;
            $log->add_time = time();
            $log->domain = 'sh0phano.com';
            $log->save();


            // lịch sử mua acc của người mua
            $user = new UsersBuy();
            $user->user_id = Auth::user()->user_id;
            $user->type = "Ngọc Rồng";
            $user->game_type = 3;
            $user->cost = $data[0]['cost'];
            $user->desc = 'Ngọc Rồng #' . $id;
            $user->info = $data[0]['info'];
            $user->status = 1;
            $user->add_time = time();
            $user->domain = 'sh0phano.com';
            $user->save();
            $trans_id = $user->id;

            // xóa ảnh khi đã bán
            foreach (glob("public/client/assets/upload/image-" . (int) $id . "-nr*") as $filename) {
                unlink($filename);
            }
            unlink(glob("public/client/assets/upload/thumb-" . (int) $id . "-nr*")[0]);

            $user_info = explode("_", $data[0]['user_post_id']);

            if (count($user_info) > 1) {
                $user_id = $user_info[1];
            } else {
                $user_id = $data[0]['user_post_id'];
            }

            // log người bán
            if (!empty($data[0]['user_post_id']) && Auth::user()->id != $user_id) {

                $user = Users::where('user_id', $user_id)->get()->toArray();

                $cash =  $user[0]['cash'] + $data[0]['cost']; // số tiền gốc

                Users::where('user_id', $user_id)->update(['cash' => $cash]);

                $log = new UsersLog();
                $log->user_id = $user_id;
                $log->trade_type = 7;
                $log->amount = $data[0]['cost'];
                $log->content = 'Tiền bán tài khoản Ngọc Rồng #' . $id . ' thành công';
                $log->last_amount = $cash;
                $log->status = 1;
                $log->add_time = time();
                $log->domain = 'sh0phano.com';
                $log->save();
            }

            $massage =  'Giao dịch thành công, mã giao dịch #' . $trans_id . '. Hãy kiểm tra <b>Tài khoản đã mua</b> trong Menu giao dịch';

            return redirect()->back()->with('message', $massage);
        }
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
