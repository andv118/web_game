<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\Ngocrong;
use App\Models\NapCham;
use App\Models\Pubg;
use App\Models\Lienquan;
use App\Models\Freefire;
use App\Models\Random;
use Hash;
use Session;
use Auth;


class HomeController extends Controller
{
    public function Home()
    {
        //count user
        $users = Users::count();

        //doanh thu
        $day = getdate()["mday"];
        $mon = getdate()["mon"];
        $year = getdate()["year"];

        $doanhthuthang = NapCham::status(1)
            ->whereMonth('date', $mon)
            ->whereYear('date', $year)
            ->sum('amount');
        $doanhthungay = NapCham::status(1)
            ->whereYear('date', $year)
            ->whereMonth('date', $mon)
            ->whereDay('date', $day)
            ->sum('amount');

        $arrdoanhthucacthang = array();
        for ($i = 1; $i <= 12; $i++) {
            $arrdoanhthucacthang[$i] = NapCham::status(1)
                ->whereMonth('date', $i)
                ->whereYear('date', $year)
                ->sum('amount');
        }

        // acc còn lại
        $pubg1 = Pubg::where('status', 0)->count();
        $lqm1 = Lienquan::where('status', 0)->count();
        $ff1 = Freefire::where('status', 0)->count();
        $nr1 = Ngocrong::where('status', 0)->count();
        $random1 = Random::where('status', 0)->count();

        // acc đã bán
        $pubg2 = Pubg::where('status', 1)->count();
        $lqm2 = Lienquan::where('status', 1)->count();
        $ff2 = Freefire::where('status', 1)->count();
        $nr2 = Ngocrong::where('status', 1)->count();
        $random2 = Random::where('status', 1)->count();

        $acc_conlai = $pubg1 + $lqm1 + $nr1 + $ff1 + $random1;
        $acc_daban = $pubg2 + $lqm2 + $nr2 + $ff2 + $random2;

        return view('admin/home', compact('users', 'doanhthuthang', 'arrdoanhthucacthang', 'doanhthungay', 'acc_daban', 'acc_conlai'));
    }


    public function ManageUsers(Request $req)
    {
        $pagination = 30;
        $id = $req->input('id');
        $keyword = $req->input('keyword');
        $title = "Danh sách tài khoản";

        $total = Users::query()
            ->keyword($keyword)
            ->count();

        $data = Users::query()
            ->keyword($keyword)
            ->id($id)
            ->orderBy('is_admin', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'keyword'   => $keyword,
            'id'   => $id,
        ];

        // dd($data);


        return view('admin/account/manage-users', compact('data', 'total', 'title', 'dataBack'));
    }


    public function CreateUsers()
    {

        return view('admin/account/create');
    }


    public function SaveUsers(Request $req)
    {

        $this->validate(
            $req,
            [
                'email' => 'email|unique:users,email',
                'password' => 'required|min:6|max:20',
                'username' => 'required',
                'phone' => 'required|unique:users,user_phone',
                'password_confirmation' => 'required|same:password'

            ],
            [
                'email.email' => 'Email không đúng định dạng',
                'email.unique' => 'Email đã thuộc về 1 tài khoản',
                'username.required' => 'Hãy nhập tên đăng nhập',
                'password.min' => 'Mật khẩu tối đa 6 ký tự',
                'password.max' => 'Mật khẩu không quá 20 ký tự',
                'password.required' => 'Mật khẩu không không được để trống',
                'password_confirmation.same' => 'Mật khẩu không khớp',
                'password_confirmation.required' => 'Hãy nhập lại mật khẩu',
                'phone.required' => 'Hãy nhập số điện thoại',
                'phone.unique' => 'Số điện thoại đã thuộc về 1 tài khoản'

            ]
        );

        function generateRandomString($length = 10)
        {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }


        $user = new Users();
        $user->name = $req->username;
        $user->user_id = generateRandomString(rand(9, 15));
        $user->email = $req->email;
        $user->user_phone = $req->phone;
        $user->password = bcrypt($req->password);
        $user->user_agent = $_SERVER["HTTP_USER_AGENT"];
        $user->is_admin = $req->role;
        $user->last_time = time();
        $user->save();

        return redirect()->back()->with('thanhcong', 'Tạo tài khoản thành công');
    }

    public function DeleteUsers($id)
    {
        $data = Users::where('id', $id)->get();
        if (count($data) > 0) {
            Users::where('id', $id)->delete();
            return redirect()->back()->with('message', 'Xóa thành công');
        }
        return redirect()->back();
    }

    public function UpdateUsers($id)
    {

        $result = Users::where('id', $id)->get()->toArray();
        if (count($result) > 0) {

            return view('admin/account/update', compact('result'));
        }
        return redirect()->back();
    }

    public function ChangeUsers(Request $req)
    {

        $this->validate(
            $req,
            [
                'cash' => 'required|integer|min:0|max:2000000000',
            ],

            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min',
                'max' => ':attribute Không được lớn hơn :max',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'cash' => 'Số tiền',
            ]
        );

        $user_id = $req->user_id;
        $locked = $req->locked;
        $email = $req->email;
        $phone = $req->phone;
        $password = $req->password;
        $cash = $req->cash;

        $arrUpdate = [
            'locked' => $locked,
            'email' => $email,
            'user_phone' => $phone,
            'cash' => $cash,
        ];

        if ($password != null) {
            $arrUpdate['password'] = bcrypt($password);
        }

        if ($user_id != null) {
            Users::query()
                ->UserId($user_id)
                ->update($arrUpdate);
        }

        return redirect()->back()->with('message', 'Cập nhật user thành công');
    }

    public function ResetAmountUser()
    {
        $isAdmin = 0;
        Users::query()
            ->where('is_admin', '=', $isAdmin)
            ->update(['cash' => 0]);
        return redirect()->route('admin.manage-users')->with('message', 'RESET thành công');
    }
}