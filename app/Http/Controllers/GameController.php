<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Settings;
use App\Models\Slides;
use App\Models\Danhmuc;
use App\Models\Ngocrong;
use App\Models\Pubg;
use App\Models\Freefire;
use App\Models\Lienquan;
use App\Models\Random;
use Hash;
use Session;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class GameController extends Controller
{

    public function tk_ngocrong(Request $request)
    {
        $pagination = 30;

        $id = $request->input('id');
        $infor = $request->input('infor');
        $user_post = $request->input('user_post');
        $status = $request->input('status');

        $total = Ngocrong::count();

        // dd($request->input());

        $ngocrong = Ngocrong::leftJoin('users', 'users.user_id', '=', 'ngoc_rong.user_post_id')
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

        return view('admin/ngocrong/index', compact('dataBack', 'total', 'ngocrong'));
    }

    public function delete_ngocrong($id)
    {
        $data = Ngocrong::where('id', $id)->get();
        if (count($data) > 0) {
            Ngocrong::where('id', $id)->delete();
            // delete image
            // delete thumb
            $thumb = glob("public/client/assets/upload/thumb-" . $id . "-nr*");
            foreach ($thumb as $key => $image) {
                $image = str_replace('public/', "", $image);
                $file_path = public_path($image); // app_path("public/test.txt");
                if (File::exists($file_path)) File::delete($file_path);
            }

            // delete image
            $arr = glob("public/client/assets/upload/image-" . $id . "-nr*");
            foreach ($arr as $key => $image) {
                $image = str_replace('public/', "", $image);
                $file_path = public_path($image); // app_path("public/test.txt");
                if (File::exists($file_path)) File::delete($file_path);
            }

            return redirect()->back()->with('message', 'Xóa thành công!');
        }
        return redirect()->back('message', 'Xóa thất bại!');
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
        $bongtai     = $request->input('bongtai');
        $note     = $request->input('note');
        $active   = $request->input('active');
        $stick    = $request->input('stick');
        $cost_atm = (int) round(($cost * 80) / 100);
        $type = 0;
        $status = 0;
        $img = '';


        // check infor(acc) đã tồn tại
        $count = Ngocrong::query()
            ->where('info', '=', $infor)
            ->select('id as counter')
            ->limit(1)
            ->get()
            ->toArray();

        if (sizeof($count) == 1) {
            return redirect()->back()->with('error', 'Infor (Tài khoản) đã tồn tại!');
        }

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

        // Xử lý ảnh
        if ($request->hasFile('thumb') && $request->hasFile('imginfo')) {
             $folder = 'assets/upload/';
            Ngocrong::insert($arrInsert);
            // get id last insert
            $lastIdInsert = DB::getPdo()->lastInsertId();

            $thumb = $request->file('thumb');
            $arrInfor = $request->file('imginfo');
            $path = 'public\client\assets\upload';

            $thumbDuoiFile = $thumb->getClientOriginalExtension();
            $name = $folder . 'thumb-' . $lastIdInsert . '-nr.' . $thumbDuoiFile;
            Storage::put($name,  File::get($thumb));

            foreach ($arrInfor as $k => $fileInfor) {
                $stt = $k + 1;
                $fileInforDuoiFile = $fileInfor->getClientOriginalExtension();
                $name = $folder . 'image-' . $lastIdInsert . '-nr_' . $stt . '.' . $fileInforDuoiFile;
                Storage::put($name,  File::get($fileInfor));
            }
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
        $bongtai     = $request->input('bongtai');
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

    public function tk_random(Request $request)
    {
        $pagination = 30;

        $id = $request->input('id');
        $infor = $request->input('infor');
        $user_post = $request->input('user_post');
        $status = $request->input('status');
        $type = $request->input('type');
        $strType = null;
        switch ($type) {
            case 1:
                $strType = 'Random Ngọc Rồng';
                break;
            case 2:
                $strType = 'Random PUBG';
                break;
            case 3:
                $strType = 'Random Liên Quân';
                break;
            case 4:
                $strType = 'Random Free Fire';
                break;
            case 5:
                $strType = 'Random Liên Minh';
                break;
            case 6:
                $strType = 'Mở Rương';
                break;
        }

        $total = Random::count();

        // dd($request->input());

        $random = Random::leftJoin('users', 'users.user_id', '=', 'random.user_post_id')
            ->select('random.*', 'users.name')
            ->id($id)
            ->status($status)
            ->infor($infor)
            ->CTV($user_post)
            ->type($strType)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'id'        => $id,
            'infor'     => $infor,
            'user_post' => $user_post,
            'status'    => $status,
            'type'      => $type,
        ];
        return view('admin/random/index', compact('dataBack', 'total', 'random'));
    }

    public function create_random(Request $request)
    {
        $this->validate(
            $request,
            [
                'type' => 'required',
                'category' => 'required',
                'infor' => 'required',
            ],

            [
                'required' => ':attribute Không được để trống',
            ],

            [
                'type' => 'Danh mục',
                'category' => 'Loại',
                'infor' => 'Tài khoản',
            ]
        );

        $arrCost = [
            0 => [20000, 50000, 100000],
            1 => [10000, 50000, 100000],
            2 => [10000, 50000, 100000],
            3 => [10000, 50000, 100000],
            4 => [10000, 50000, 100000],
            5 => [10000, 50000, 100000],
        ];

        $arrCategory = [
            0 => ['Vận May Ngọc Rồng 20K', 'Vận May Ngọc Rồng 50K', 'Vận May Ngọc Rồng 100K'],
            1 => ['Vận May Liên Quân 10K', 'Vận May Liên Quân 50K', 'Vận May Liên Quân 100K'],
            2 => ['Vận May Free Fire 10K', 'Vận May Free Fire 50K', 'Vận May Free Fire 100K'],
            3 => ['Vận May PUBG 10K', 'Vận May PUBG 50K', 'Vận May PUBG 100K'],
        ];

        $user_id = Auth::user()->user_id;
        $status = 0;
        $type = $request->input('type');
        $infor = $request->input('infor');
        $intCategory = $request->input('category');

        // get category
        $category = '';
        foreach ($arrCategory[$type] as $k => $v) {
            if ($intCategory == $k) {
                $category = $v;
            }
        }

        // get cost
        $cost = $arrCost[$type][$intCategory];
        $cost_atm = (int) round(($cost * 80) / 100);

        // get type
        switch ($type) {
            case 0:
                $type = "Random Ngọc Rồng";
                break;
            case 1:
                $type = "Random PUBG";
                break;
            case 2:
                $type = "Random Liên Quân";
                break;
            case 3:
                $type = "Random Free Fire";
                break;
            case 4:
                $type = "Random Liên Minh";
                break;
            case 5:
                $type = "Random Mở Rương";
                break;
        }

        $arrInsert = [
            'user_post_id' => $user_id,
            'type' => $type,
            'info' => $infor,
            'cost' => $cost,
            'cost_atm' => $cost_atm,
            'status' => $status,
            'add_time' => time(),
            'category' => $category,
        ];

        Random::insert($arrInsert);

        // dd($arrInsert);
        return redirect()->back()->with('message', 'Thêm tài khoản thành công!');
    }

    public function update_random(Request $request)
    {
        // dd($request->input());

        $arrCost = [
            0 => [20000, 50000, 100000],
            1 => [10000, 50000, 100000],
            2 => [10000, 50000, 100000],
            3 => [10000, 50000, 100000],
            4 => [10000, 50000, 100000],
            5 => [10000, 50000, 100000],
        ];

        $arrCategory = [
            0 => ['Vận May Ngọc Rồng 20K', 'Vận May Ngọc Rồng 50K', 'Vận May Ngọc Rồng 100K'],
            1 => ['Vận May Liên Quân 10K', 'Vận May Liên Quân 50K', 'Vận May Liên Quân 100K'],
            2 => ['Vận May Free Fire 10K', 'Vận May Free Fire 50K', 'Vận May Free Fire 100K'],
            3 => ['Vận May PUBG 10K', 'Vận May PUBG 50K', 'Vận May PUBG 100K'],
        ];

        $id          = $request->input('id');
        $type        = $request->input('type');
        $infor       = $request->input('infor');
        $intCategory = $request->input('category');

        // get category
        $category = '';
        foreach ($arrCategory[$type] as $k => $v) {
            if ($intCategory == $k) {
                $category = $v;
            }
        }

        // get cost
        $cost = $arrCost[$type][$intCategory];
        $cost_atm = (int) round(($cost * 80) / 100);

        // get type
        switch ($type) {
            case 0:
                $type = "Random Ngọc Rồng";
                break;
            case 1:
                $type = "Random PUBG";
                break;
            case 2:
                $type = "Random Liên Quân";
                break;
            case 3:
                $type = "Random Free Fire";
                break;
            case 4:
                $type = "Random Liên Minh";
                break;
            case 5:
                $type = "Random Mở Rương";
                break;
        }

        $arrUpdate = [
            'type' => $type,
            'info' => $infor,
            'cost' => $cost,
            'cost_atm' => $cost_atm,
            'category' => $category,
        ];

        if ($id != null) {
            Random::query()
                ->id($id)
                ->update($arrUpdate);
        }

        // dd($arrInsert);
        return redirect()->back()->with('message', 'Cập nhật tài khoản thành công!');
    }

    public function delete_random($id)
    {
        $data = Random::where('id', $id)->get();
        if (count($data) > 0) {
            Random::where('id', $id)->delete();
            return redirect()->back()->with('message', 'Xóa thành công!');
        }
        return redirect()->back('message', 'Xóa thất bại!');
    }

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