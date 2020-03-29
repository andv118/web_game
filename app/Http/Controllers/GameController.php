<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UsersBuy;
use App\Models\UsersLog;
use App\Models\Ngocrong;
use App\Models\Pubg;
use App\Models\Freefire;
use App\Models\Lienquan;
use App\Models\Random;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use App\Object\Game\GameNgocRong;


class GameController extends Controller
{

    /*********************** Ngọc Rồng User ***************/
    /**
     * Get list tài khoản ngọc rồng
     * @param string
     * @return view
     */
    public function ngoc_rong($param, Request $request)
    {
        $pagination = 20;
        $userCash = Auth::user()->cash;
        $ngocrong = new GameNgocRong();
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
            $title = "Tài khoản ngọc rồng tầm trung";
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
            ->whereRaw("IF(active = 0, cost > " . $userCash . ", cost > 0)")
            ->orderBy('stick', 'desc')
            ->orderBy('date', 'desc')
            ->paginate($pagination);
        // dd($data);
        // luu session old    
        session()->flashInput($request->input());
        return view('user/ngocrong/index', compact('title', 'data', 'ngocrong'));
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
                $price1 = 1;
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
                $price1 = 5000000;
                break;
            case 7:
                $price1 = 10000000;
                break;
        }
        return [
            'price1' => $price1,
            'price2' => $price2,
        ];
    }

    /**
     * Get tài khoản ngọc rồng chi tiết theo id
     * @param string
     * @return view
     */
    public function chi_tiet_ngoc_rong($id)
    {
        $ngocrong = new GameNgocRong();
        if (isset($id)) {
            $data = Ngocrong::where('id', $id)
                ->where('type', 0)
                ->get();
            if (count($data) > 0) {
                $data2 = Ngocrong::where('id', '<>', $id)
                    ->where('status', 0)
                    ->inRandomOrder()
                    ->take(8)
                    ->get();
                return view('user/chitietngocrong/index', compact('data', 'data2', 'ngocrong'));
            } else {
                return redirect()->route('index');
            }
        }
    }

    public function thanh_toan_ngoc_rong(Request $request)
    {
        $id = $request->input('id');
        $cost = $request->input('cost');
        $root = request()->root();
        $userPostId = null;
        $trade = 5; // mua tai khoan
        $UserPostTrade = 7; // ban tai khoan
        // kiểm tra đầu vào
        $locked = Auth::user()->locked;
        $cashUser = Auth::user()->cash;
        $user_id = Auth::user()->user_id;
        if ($locked == 1) {
            return redirect()->back()->withErrors('Tài khoản của bạn đã bị chặn giao dịch');
        } elseif ($cashUser < $cost) {
            return redirect()->back()->withErrors('Tài khoản không đủ tiền để thực hiện giao dịch');
        }

        // trừ tiền người mua - cộng tiền người bán
        $lastCash = $cashUser - $cost;
        Users::query()
            ->UserId($user_id)
            ->update(['cash' => $lastCash]);

        $ngocRong = Ngocrong::query()
            ->id($id)
            ->select('user_post_id')
            ->limit(1)
            ->first();
        $userPostId = $ngocRong->user_post_id;
        if (Users::query()->UserId($userPostId)->count() > 0) {
            // ton tai user post id trong table users -> cong tien
            $cashUserPost = Users::query()->UserId($userPostId)->first();
            $lastCashUserPost = $cashUserPost->cash + $cost;
            Users::query()
                ->UserId($userPostId)
                ->update(['cash' => $lastCashUserPost]);
        }

        // update status ngoc rong
        Ngocrong::where('id', $id)->update(['status' => 1, 'active' => 1]);

        // xoa anh
        $gameNgocRong = new GameNgocRong();
        $gameNgocRong->deleteImage($id);

        // insert userLog nguoi mua
        $log = new UsersLog();
        $log->user_id = $user_id;
        $log->trade_type = $trade;
        $log->amount = $cost;
        $log->last_amount = $lastCash;
        $log->content = 'Mua tài khoản Ngọc Rồng' . ' #' . $id;
        $log->add_time = time();
        $log->domain = $root;
        $log->save();

        // insert userLog người bán
        if (Users::query()->UserId($userPostId)->count() > 0) {
            // ton tai user post id trong table users -> cong tien
            $cashUserPost = Users::query()->UserId($userPostId)->first();

            $log = new UsersLog();
            $log->user_id = $userPostId;
            $log->trade_type = $UserPostTrade;
            $log->amount = $cost;
            $log->last_amount = $cashUserPost->cash;
            $log->content = 'Bán tài khoản Ngọc Rồng' . ' #' . $id;
            $log->add_time = time();
            $log->domain = $root;
            $log->save();
        }

        // insert usersBuy Người mua
        $ngocRongData = Ngocrong::query()->id($id)->first();

        $userBuy = new UsersBuy();
        $userBuy->user_id = $user_id;
        $userBuy->game_type = 3;
        $userBuy->type = "Ngọc Rồng";
        $userBuy->cost = $cost;
        $userBuy->desc = 'Ngọc Rồng #' . $id;
        $userBuy->info = $ngocRongData->info;
        $userBuy->status = 1;
        $userBuy->add_time = time();
        $userBuy->domain = $root;
        $userBuy->save();
        $trans_id = $userBuy->id;


        $massage =  'Giao dịch thành công, mã giao dịch #' . $trans_id . '. Hãy kiểm tra <b>Tài khoản đã mua</b> trong Menu giao dịch';
        return redirect()->back()->with('message', $massage);
    }

    /*********************** Ngọc Rồng Admin ***************/

    public function tk_ngocrong(Request $request)
    {
        $pagination = 30;

        $ngocrong = new GameNgocRong();
        $id = $request->input('id');
        $infor = $request->input('infor');
        $user_post = $request->input('user_post');
        $status = $request->input('status');

        $total = Ngocrong::count();

        $data = Ngocrong::leftJoin('users', 'users.user_id', '=', 'ngoc_rong.user_post_id')
            ->select('ngoc_rong.*', 'users.name')
            ->id($id)
            ->status($status)
            ->infor($infor)
            ->CTV($user_post)
            ->orderBy('stick', 'desc')
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'id'        => $id,
            'infor'     => $infor,
            'user_post' => $user_post,
            'status'    => $status,
        ];

        return view('admin/ngocrong/index', compact('dataBack', 'total', 'data', 'ngocrong'));
    }

    public function delete_ngocrong($id)
    {
        if (Ngocrong::where('id', $id)->count() > 0) {
            // delete db
            Ngocrong::where('id', $id)->delete();
            // delete image
            $gameNgocRong = new GameNgocRong();
            $gameNgocRong->deleteImage($id);
            return redirect()->back()->with('message', 'Xóa thành công!');
        }
        return redirect()->back()->withErrors('Xóa thất bại!');
    }

    public function add_ngocrong(Request $request)
    {
        // dd($request->input());
        $this->validate(
            $request,
            [
                'cost' => 'required|integer|min:0|max:100000000',
                'thumb' => 'max:512',
                'imginfo' => 'max:2048',
            ],

            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'cost' => 'Số tiền',
                'thumb' => 'Ảnh đại diện',
                'imginfo' => 'Ảnh thông tin',
            ]
        );

        $user_id = Auth::user()->user_id;
        $infor    = $request->input('infor');
        $cost     = $request->input('cost');
        $dangky   = $request->input('dangky');
        $server   = $request->input('server');
        $hanhtinh = $request->input('hanhtinh');
        $detu     = $request->input('detu');
        $bongtai  = $request->input('bongtai');
        $note     = $request->input('note');
        $active   = $request->input('active');
        $stick    = $request->input('stick');
        $cost_atm = (int) round(($cost * 80) / 100);
        $type = 0;
        $status = 0;
        $img = '';

        // check infor(acc) đã tồn tại
        if (Ngocrong::where('info', '=', $infor)->count() > 0) {
            return redirect()->back()->withErrors('Infor (Tài khoản) đã tồn tại!');
        }
        // insert db
        $arrInsert = [
            'user_post_id' => $user_id,
            'type' => $type,
            'info' => $infor,
            'dk' => $dangky,
            'server' => $server,
            'hanhtinh' => $hanhtinh,
            'bongtai' => $bongtai,
            'detu' => $detu,
            'cost' => $cost,
            'cost_atm' => $cost_atm,
            'note' => $note,
            'status' => $status,
            'active' => $active,
            'img' => $img,
            'add_time' => time(),
            'stick' => $stick,
        ];
        Ngocrong::insert($arrInsert);

        // upload anh
        if ($request->hasFile('thumb') && $request->hasFile('imginfo')) {
            // get id last insert
            $lastIdInsert = DB::getPdo()->lastInsertId();
            $thumb = $request->file('thumb');
            $arrInfor = $request->file('imginfo');
            $ngocrong = new GameNgocRong();
            $ngocrong->uploadImage($lastIdInsert, $thumb, $arrInfor);
        }

        return redirect()->back()->with('message', 'Thêm tài khoản thành công!');
    }

    public function change_ngocrong(Request $request)
    {
        $this->validate(
            $request,
            [
                'cost' => 'required|integer|min:0|max:100000000',
            ],

            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'cost' => 'Số tiền',
            ]
        );

        // dd($request->input());
        $id       = $request->input('id');
        $infor    = $request->input('infor');
        $cost     = $request->input('cost');
        $dangky   = $request->input('dangky');
        $server   = $request->input('server');
        $hanhtinh = $request->input('hanhtinh');
        $detu     = $request->input('detu');
        $bongtai  = $request->input('bongtai');
        $note     = $request->input('note');
        $active   = $request->input('active');
        $stick    = $request->input('stick');
        $cost_atm = (int) round(($cost * 80) / 100);

        // dd($infor);

        $arrInsert = [
            'info' => $infor,
            'dk' => $dangky,
            'server' => $server,
            'hanhtinh' => $hanhtinh,
            'bongtai' => $bongtai,
            'detu' => $detu,
            'cost' => $cost,
            'cost_atm' => $cost_atm,
            'note' => $note,
            'active' => $active,
            'stick' => $stick,
        ];
        Ngocrong::query()
            ->id($id)
            ->update($arrInsert);

        return redirect()->back()->with('message', 'Cập nhật tài khoản thành công!');
    }

   

    /*********************** Game khac User ***************/
    public function tk_pubg()
    {

        $data = [];
        $total = Pubg::count();
        $pubg = Pubg::paginate(20);
        foreach ($pubg as $value) {
            $user_id = $value->user_post_id;
            $user = $this->getUserInfo($user_id);
            $array = [
                'id' => $value->id,
                'info' => $value->info,
                'user_name' => $user[0]['name'],
                'user_email' => $user[0]['email'],
                'user_phone' => $user[0]['user_phone'],
                'user_id' => $user[0]['user_id'],
                'dangnhap' => $value->dangNhap,
                'cost' => $value->cost,
                'status' => $value->status

            ];

            $data[] = $array;
        }

        // echo '<pre>';
        // print_r($data);

        return view('admin/pubg/index', compact('data', 'total', 'pubg'));
    }


    public function tk_freefire()
    {

        $data = [];
        $total = Freefire::count();
        $freefire = Freefire::paginate(20);
        foreach ($freefire as $value) {
            $user_id = $value->user_post_id;
            $user = $this->getUserInfo($user_id);
            $array = [
                'id' => $value->id,
                'info' => $value->info,
                'user_name' => $user[0]['name'],
                'user_email' => $user[0]['email'],
                'user_phone' => $user[0]['user_phone'],
                'user_id' => $user[0]['user_id'],
                'dangnhap' => $value->dangNhap,
                'cost' => $value->cost,
                'status' => $value->status

            ];

            $data[] = $array;
        }

        // echo '<pre>';
        // print_r($data);

        return view('admin/freefire/index', compact('data', 'total', 'freefire'));
    }


    public function tk_lienquan()
    {

        $data = [];
        $total = Lienquan::count();
        $lienquan = Lienquan::paginate(20);
        foreach ($lienquan as $value) {
            $user_id = $value->user_post_id;
            $user = $this->getUserInfo($user_id);
            $array = [
                'id' => $value->id,
                'info' => $value->info,
                'user_name' => $user[0]['name'],
                'user_email' => $user[0]['email'],
                'user_phone' => $user[0]['user_phone'],
                'user_id' => $user[0]['user_id'],
                'rank' => $value->rank,
                'cost' => $value->cost,
                'status' => $value->status

            ];

            $data[] = $array;
        }

        // echo '<pre>';
        // print_r($data);

        return view('admin/lienquan/index', compact('data', 'total', 'lienquan'));
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
}
