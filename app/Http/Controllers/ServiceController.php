<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\Ngocrong;
use App\Models\Slides;
use App\Models\Danhmuc;
use App\Models\UsersLog;
use App\Models\UsersService;
use Hash;
use Session;
use Auth;


class ServiceController extends Controller
{

    public function ban_vang()
    {
        return view('user.dichvu.ngocrong.ban_vang');
    }

    public function ban_vang_pay(Request $request)
    {
        $min = 20000;
        $max = 500000;
        $currentMoney = Auth::user()['cash'];
        $userId = Auth::user()['user_id'];
        $trade_type = 2;

        $server = $request->input('server');
        $price = $request->input('price');
        $acc = $request->input('acc');
        $pass = $request->input('pass');
        $vang = $request->input('vang');
        $price = preg_replace('/[^0-9]/', '', $price);
        $vang = preg_replace('/[^0-9]/', '', $vang);


        $lock = Auth::user()['locked'];
        // check validate
        if ($lock == 1) {
            return redirect()->back()->with('errors', 'Tài khoản đã bị khóa giao dịch!');
        } elseif ($price < $min || $price > $max) {
            return redirect()->back()->with('errors', 'Số tiền thanh toán sai! Từ 20,000 đến 500,000đ');
        } elseif ($currentMoney < $price) {
            return redirect()->back()->with('errors', 'Số tiền không đủ để thanh toán');
        }

        // luu db
        $arrInsert = [
            'user_id' => $userId,
            'trade_type' => $trade_type,
            'total_price' => $price,
            'status' => 1,
            'desc_status' => 'Chờ xác nhận',
            'customer_acc' => $acc,
            'customer_pass' => $pass,
            'customer_action' => 'Mua ' . $vang . ' vàng máy chủ vũ trụ ' . $server,
            'customer_data' => $acc . '|' . $pass,
            'domain' => $request->root(),
        ];
        UsersService::insert($arrInsert);
        // tru tien
        $lastMoney = $currentMoney - $price;
        Users::query()
            ->userId($userId)
            ->update(['cash' => $lastMoney]);

        return redirect()->back()->with('success', 'Thanh toán thành công!');
    }

    public function ban_ngoc()
    {
        return view('user.dichvu.ngocrong.ban_ngoc');
    }

    public function ban_ngoc_pay(Request $request)
    {
        $min = 50000;
        $max = 500000;
        $currentMoney = Auth::user()['cash'];
        $userId = Auth::user()['user_id'];
        $trade_type = 1;

        $server = $request->input('server');
        $price = $request->input('price');
        $acc = $request->input('acc');
        $pass = $request->input('pass');
        $vang = $request->input('vang');
        $price = preg_replace('/[^0-9]/', '', $price);
        $vang = preg_replace('/[^0-9]/', '', $vang);

        $lock = Auth::user()['locked'];
        // check validate
        if ($lock == 1) {
            return redirect()->back()->with('errors', 'Tài khoản đã bị khóa giao dịch!');
        } elseif ($price < $min || $price > $max) {
            return redirect()->back()->with('errors', 'Số tiền thanh toán sai! Từ 50,000 đến 500,000đ');
        } elseif ($currentMoney < $price) {
            return redirect()->back()->with('errors', 'Số tiền không đủ để thanh toán');
        }

        // luu db
        $arrInsert = [
            'user_id' => $userId,
            'trade_type' => $trade_type,
            'total_price' => $price,
            'status' => 1,
            'desc_status' => 'Chờ xác nhận',
            'customer_acc' => $acc,
            'customer_pass' => $pass,
            'customer_action' => 'Mua ' . $vang . ' ngọc máy chủ vũ trụ ' . $server,
            'customer_data' => $acc . '|' . $pass,
            'domain' => $request->root(),
        ];
        UsersService::insert($arrInsert);
        // tru tien
        $lastMoney = $currentMoney - $price;
        Users::query()
            ->userId($userId)
            ->update(['cash' => $lastMoney]);

        return redirect()->back()->with('success', 'Thanh toán thành công!');
    }

    public function nhiem_vu()
    {
        return view('user.dichvu.ngocrong.lam_nhiem_vu');
    }

    public function nhiem_vu_pay(Request $request)
    {
        $currentMoney = Auth::user()['cash'];
        $userId = Auth::user()['user_id'];
        $lock = Auth::user()['locked'];
        $trade_type = 3;

        $server = $request->input('server');
        $acc = $request->input('acc');
        $pass = $request->input('pass');
        $price = $request->input('vang');
        $item = $request->input('item');
        $price = preg_replace('/[^0-9]/', '', $price);
        $arrItem = [
            "Tiểu Đội Sát Thủ - 250k",
            "Tiêu Diệt Fide - 150k",
            "Apk 19 20 - 100k",
            "Apk 13 14 15 - 100k",
            "Pick - king kong - 200k",
            "xbh1 -xht - 400k"
        ];

        $item = explode('|', $item);
        $customerSelect = '';
        foreach ($item as $v) {
            if ($customerSelect == '') {
                $customerSelect .= $arrItem[$v] . ' - Vũ trụ ' . $server;
            } else {
                $customerSelect .= '|' . $arrItem[$v] . ' - Vũ trụ ' . $server;
            }
        }

        // check validate
        if ($lock == 1) {
            return redirect()->back()->with('errors', 'Tài khoản đã bị khóa giao dịch!');
        } elseif ($price == null) {
            return redirect()->back()->with('errors', 'Chọn dịch vụ để thanh toán');
        } elseif ($currentMoney < $price) {
            return redirect()->back()->with('errors', 'Số tiền không đủ để thanh toán');
        }

        // luu db
        $arrInsert = [
            'user_id' => $userId,
            'trade_type' => $trade_type,
            'total_price' => $price,
            'status' => 1,
            'desc_status' => 'Chờ xác nhận',
            'customer_acc' => $acc,
            'customer_pass' => $pass,
            'customer_action' => $customerSelect,
            'customer_data' => $acc . '|' . $pass,
            'domain' => $request->root(),
        ];
        UsersService::insert($arrInsert);
        // tru tien
        $lastMoney = $currentMoney - $price;
        Users::query()
            ->userId($userId)
            ->update(['cash' => $lastMoney]);

        return redirect()->back()->with('success', 'Thanh toán thành công!');
    }

    public function bi_kip()
    {
        return view('user.dichvu.ngocrong.bi_kip');
    }

    public function bi_kip_pay(Request $request)
    {
        $currentMoney = Auth::user()['cash'];
        $userId = Auth::user()['user_id'];
        $lock = Auth::user()['locked'];
        $trade_type = 5;

        $server = $request->input('server');
        $acc = $request->input('acc');
        $pass = $request->input('pass');
        $price = $request->input('vang');
        $item = $request->input('item');
        $price = preg_replace('/[^0-9]/', '', $price);
        $arrItem = [
            "1000 bí kíp - 100k",
            "2000 bí kíp - 200k",
            "3000 bí kíp - 300k",
            "4000 bí kíp - 400k",
            "5000 bí kíp - 500k",
            "6000 bí kíp - 600k",
            "7000 bí kíp - 700k",
            "8000 bí kíp - 800k",
            "9000 bí kíp - 900k",
            "10000 bí kíp - 1000k",
        ];

        $item = explode('|', $item);
        $customerSelect = '';
        foreach ($item as $v) {
            if ($customerSelect == '') {
                $customerSelect .= $arrItem[$v] . ' - Vũ trụ ' . $server;
            } else {
                $customerSelect .= '|' . $arrItem[$v] . ' - Vũ trụ ' . $server;
            }
        }

        // check validate
        if ($lock == 1) {
            return redirect()->back()->with('errors', 'Tài khoản đã bị khóa giao dịch!');
        } elseif ($price == null) {
            return redirect()->back()->with('errors', 'Chọn dịch vụ để thanh toán');
        } elseif ($currentMoney < $price) {
            return redirect()->back()->with('errors', 'Số tiền không đủ để thanh toán');
        }

        // luu db
        $arrInsert = [
            'user_id' => $userId,
            'trade_type' => $trade_type,
            'total_price' => $price,
            'status' => 1,
            'desc_status' => 'Chờ xác nhận',
            'customer_acc' => $acc,
            'customer_pass' => $pass,
            'customer_action' => $customerSelect,
            'customer_data' => $acc . '|' . $pass,
            'domain' => $request->root(),
        ];
        UsersService::insert($arrInsert);
        // tru tien
        $lastMoney = $currentMoney - $price;
        Users::query()
            ->userId($userId)
            ->update(['cash' => $lastMoney]);

        return redirect()->back()->with('success', 'Thanh toán thành công!');
    }

    public function su_phu()
    {
        return view('user.dichvu.ngocrong.up_su_phu');
    }

    public function su_phu_pay(Request $request)
    {
        $currentMoney = Auth::user()['cash'];
        $userId = Auth::user()['user_id'];
        $lock = Auth::user()['locked'];
        $trade_type = 7;

        $server = $request->input('server');
        $acc = $request->input('acc');
        $pass = $request->input('pass');
        $price = $request->input('vang');
        $item = $request->input('item');
        $price = preg_replace('/[^0-9]/', '', $price);
        $arrItem = [
            "Combo1 sơ sinh - 200tr - 150K",
            "Combo2 200tr sm - 10ty - 250K",
            "Combo2*1 : 200tr sm - 5ty - 150K",
            "Combo2*2 : 5ty sm - 10ty - 150K",
            "Combo3 10 ty sm - 20 ty - 200K",
            "Combo3 * 1: 10 ty sm - 15 ty - 100K",
            "Combo3 * 2: 15 ty sm - 20 ty - 100K",
            "Combo4 20 ty sm - 30 ty - 170K",
            "Combo4 * 1: 30 ty sm - 35 ty - 100K",
            "Combo4 * 2: 35 ty sm - 40 ty - 100K",
            "Combo5 30 ty sm - 40 ty - 170K",
            "Combo6 sơ sinh - 40 t - 1,000K",
        ];

        $item = explode('|', $item);
        $customerSelect = '';
        foreach ($item as $v) {
            if ($customerSelect == '') {
                $customerSelect .= $arrItem[$v] . ' - Vũ trụ ' . $server;
            } else {
                $customerSelect .= '|' . $arrItem[$v] . ' - Vũ trụ ' . $server;
            }
        }

        // check validate
        if ($lock == 1) {
            return redirect()->back()->with('errors', 'Tài khoản đã bị khóa giao dịch!');
        } elseif ($price == null) {
            return redirect()->back()->with('errors', 'Chọn dịch vụ để thanh toán');
        } elseif ($currentMoney < $price) {
            return redirect()->back()->with('errors', 'Số tiền không đủ để thanh toán');
        }

        // luu db
        $arrInsert = [
            'user_id' => $userId,
            'trade_type' => $trade_type,
            'total_price' => $price,
            'status' => 1,
            'desc_status' => 'Chờ xác nhận',
            'customer_acc' => $acc,
            'customer_pass' => $pass,
            'customer_action' => $customerSelect,
            'customer_data' => $acc . '|' . $pass,
            'domain' => $request->root(),
        ];
        UsersService::insert($arrInsert);
        // tru tien
        $lastMoney = $currentMoney - $price;
        Users::query()
            ->userId($userId)
            ->update(['cash' => $lastMoney]);

        return redirect()->back()->with('success', 'Thanh toán thành công!');
    }

    public function de_tu()
    {
        return view('user.dichvu.ngocrong.up_de_tu');
    }

    public function de_tu_pay(Request $request)
    {
        $currentMoney = Auth::user()['cash'];
        $userId = Auth::user()['user_id'];
        $lock = Auth::user()['locked'];
        $trade_type = 6;

        $server = $request->input('server');
        $acc = $request->input('acc');
        $pass = $request->input('pass');
        $price = $request->input('vang');
        $item = $request->input('item');
        $price = preg_replace('/[^0-9]/', '', $price);
        $arrItem = [
            "Sơ sinh- 1tr5 - 70K",
            "1tr5 -15tr - 70K",
            "15tr -50tr - 100K",
            "50tr - 100tr - 100K",
            "100tr - 150tr - 100K",
            "50tr -149tr - 200K",
            "Sơ sinh - 149tr - 400K",
            "Skill Kame từ c3-7 : 150tr-1ti499 - 400K",
            "Skill Atm từ c3-7 : 150tr-1ti499 - 420K",
            "Skill Msk từ c4-7 : 150tr-1499 - 700K",
        ];

        $item = explode('|', $item);
        $customerSelect = '';
        foreach ($item as $v) {
            if ($customerSelect == '') {
                $customerSelect .= $arrItem[$v] . ' - Vũ trụ ' . $server;
            } else {
                $customerSelect .= '|' . $arrItem[$v] . ' - Vũ trụ ' . $server;
            }
        }

        // check validate
        if ($lock == 1) {
            return redirect()->back()->with('errors', 'Tài khoản đã bị khóa giao dịch!');
        } elseif ($price == null) {
            return redirect()->back()->with('errors', 'Chọn dịch vụ để thanh toán');
        } elseif ($currentMoney < $price) {
            return redirect()->back()->with('errors', 'Số tiền không đủ để thanh toán');
        }

        // luu db
        $arrInsert = [
            'user_id' => $userId,
            'trade_type' => $trade_type,
            'total_price' => $price,
            'status' => 1,
            'desc_status' => 'Chờ xác nhận',
            'customer_acc' => $acc,
            'customer_pass' => $pass,
            'customer_action' => $customerSelect,
            'customer_data' => $acc . '|' . $pass,
            'domain' => $request->root(),
        ];
        UsersService::insert($arrInsert);
        // tru tien
        $lastMoney = $currentMoney - $price;
        Users::query()
            ->userId($userId)
            ->update(['cash' => $lastMoney]);

        return redirect()->back()->with('success', 'Thanh toán thành công!');
    }

    public function san_de_tu()
    {
        return view('user.dichvu.ngocrong.san_de_tu');
    }

    public function san_de_tu_pay(Request $request)
    {
        $currentMoney = Auth::user()['cash'];
        $userId = Auth::user()['user_id'];
        $lock = Auth::user()['locked'];
        $trade_type = 4;

        $server = $request->input('server');
        $acc = $request->input('acc');
        $pass = $request->input('pass');
        $price = $request->input('vang');
        $item = $request->input('item');
        $price = preg_replace('/[^0-9]/', '', $price);
        $arrItem = [
            "Xayda - 50K",
            "Trái đất - 50K",
            "Namec - 50K",
            "Nick sơ sinh nhiệm vụ heo rừng - 100K",
        ];

        $item = explode('|', $item);
        $customerSelect = '';
        foreach ($item as $v) {
            if ($customerSelect == '') {
                $customerSelect .= $arrItem[$v] . ' - Vũ trụ ' . $server;
            } else {
                $customerSelect .= '|' . $arrItem[$v] . ' - Vũ trụ ' . $server;
            }
        }

        // check validate
        if ($lock == 1) {
            return redirect()->back()->with('errors', 'Tài khoản đã bị khóa giao dịch!');
        } elseif ($price == null) {
            return redirect()->back()->with('errors', 'Chọn dịch vụ để thanh toán');
        } elseif ($currentMoney < $price) {
            return redirect()->back()->with('errors', 'Số tiền không đủ để thanh toán');
        }

        // luu db
        $arrInsert = [
            'user_id' => $userId,
            'trade_type' => $trade_type,
            'total_price' => $price,
            'status' => 1,
            'desc_status' => 'Chờ xác nhận',
            'customer_acc' => $acc,
            'customer_pass' => $pass,
            'customer_action' => $customerSelect,
            'customer_data' => $acc . '|' . $pass,
            'domain' => $request->root(),
        ];
        UsersService::insert($arrInsert);
        // tru tien
        $lastMoney = $currentMoney - $price;
        Users::query()
            ->userId($userId)
            ->update(['cash' => $lastMoney]);

        return redirect()->back()->with('success', 'Thanh toán thành công!');
    }
}
