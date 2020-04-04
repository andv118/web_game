<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Ngocrong;
use App\Models\NapCham;
use App\Models\Random;
use App\Models\UsersService;
use App\Models\Wheel;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function Home()
    {
        $day = getdate()["mday"];
        $mon = getdate()["mon"];
        $year = getdate()["year"];
        $firstDayOfMonth = Carbon::now()->firstOfMonth()->toDateTimeString(); // ngay dau tien cua thang

        // tong user    
        $users = Users::count();
        $usersPerformance = Users::where('date', '>=', $firstDayOfMonth)->count();
        // tong so du
        $amounts = Users::where('is_admin', 0)->sum('cash');
        $amountsPerformance = Users::where('date', '<', $firstDayOfMonth)->where('is_admin', 0)->sum('cash');
        $amountsPercent = (($amounts - $amountsPerformance) / $amountsPerformance) * 100;

        // the cao
        $cards = NapCham::where('status', 1)->count();
        $cardsPerformance = NapCham::where('date', '>=', $firstDayOfMonth)->count();

        $cardsAmount = NapCham::where('status', 1)->sum('amount');
        $cardsAmountPerformance = NapCham::where('status', 1)->where('date', '>=', $firstDayOfMonth)->sum('amount');

        // doanh thu
        $previousMonth = Carbon::now()->subMonth()->format('m');

        $doanhThu = array();
        $doanhThu['ThangTruoc'] = $this->getDoanhThu($year, $previousMonth, null);
        $doanhThu['ThangNay'] = $this->getDoanhThu($year, $mon, null);
        $doanhThu['HomNay'] = $this->getDoanhThu($year, $mon, $day);
        $doanhThu['tong'] = $this->getDoanhThu(null, null, null);

        // so nick da ban
        $acc = array();
        $acc['ThangTruoc'] = $this->getNickDaBan($year, $previousMonth, null);
        $acc['ThangNay'] = $this->getNickDaBan($year, $mon, null);
        $acc['HomNay'] = $this->getNickDaBan($year, $mon, $day);
        $acc['tong'] = $this->getNickDaBan(null, null, null);

        // doanh thu game (thống kê theo ngày/tháng)

        $arrdoanhthugame = array();

        $arrdoanhthugame['ngoc_rong']['day'] = $this->doanhThuNgocRong($year, $mon, $day);
        $arrdoanhthugame['ngoc_rong']['mon'] = $this->doanhThuNgocRong($year, $mon, null);

        $arrdoanhthugame['random']['day'] =  $this->doanhThuRandom($year, $mon, $day);
        $arrdoanhthugame['random']['mon'] = $this->doanhThuRandom($year, $mon, null);

        $arrdoanhthugame['dich_vu']['day'] = $this->doanhThuServie($year, $mon, $day);
        $arrdoanhthugame['dich_vu']['mon'] = $this->doanhThuServie($year, $mon, null);

        $arrdoanhthugame['vong_quay']['day'] = $this->doanhThuWheel($year, $mon, $day);
        $arrdoanhthugame['vong_quay']['mon'] = $this->doanhThuWheel($year, $mon, null);

        return view('admin/home', compact(
            'arrdoanhthugame',
            'day',
            'users',
            'usersPerformance',
            'amounts',
            'amountsPercent',
            'cards',
            'cardsPerformance',
            'cardsAmount',
            'cardsAmountPerformance',
            'doanhThu',
            'acc'
        ));
    }

    /**
     * get doanh thu theo ngày tháng năm
     * @param int, int, int
     * @return int
     */
    public function getDoanhThu($year, $mon, $day)
    {
        $doanhthu = $this->doanhThuNgocRong($year, $mon, $day) + $this->doanhThuRandom($year, $mon, $day) + $this->doanhThuServie($year, $mon, $day);
        return $doanhthu;
        // $amountNgocRong = Ngocrong::where('status', 1)
        //     ->year($year)
        //     ->month($mon)
        //     ->day($day)
        //     ->sum('cost');
        // $amountRandom = Random::where('status', 1)
        //     ->year($year)
        //     ->month($mon)
        //     ->day($day)
        //     ->sum('cost');
        // $amountService = UsersService::where('status', 3)
        //     ->year($year)
        //     ->month($mon)
        //     ->day($day)
        //     ->sum('total_price');
        // return ($amountNgocRong + $amountRandom + $amountService);
    }

    /**
     * get nick đã bán theo ngày tháng năm
     * @param int, int, int
     * @return int
     */
    public function getNickDaBan($year, $mon, $day)
    {
        $amountNgocRong = Ngocrong::where('status', 1)
            ->year($year)
            ->month($mon)
            ->day($day)
            ->count();
        $amountRandom = Random::where('status', 1)
            ->year($year)
            ->month($mon)
            ->day($day)
            ->count();
        return ($amountNgocRong + $amountRandom);
    }

    /**
     * Doanh thu game ngọc rồng theo ngày tháng năm
     * @param string
     * @return int
     */
    public function doanhThuNgocRong($year, $mon, $day)
    {   
        $type = 0; // ngoc rong
        $amountNgocRong = Ngocrong::where('status', 1)
            ->where('type', $type)
            ->year($year)
            ->month($mon)
            ->day($day)
            ->sum('cost');
        return $amountNgocRong;
    }

    /**
     * Doanh thu game random theo ngày tháng năm
     * @param string
     * @return int
     */
    public function doanhThuRandom($year, $mon, $day)
    {
        $amountRandom = Random::where('status', 1)
            ->year($year)
            ->month($mon)
            ->day($day)
            ->sum('cost');
        return $amountRandom;
    }

    /**
     * Doanh thu game dịch vụ theo ngày tháng năm
     * @param string
     * @return int
     */
    public function doanhThuServie($year, $mon, $day)
    {
        $amountService = UsersService::where('status', 3)
            ->year($year)
            ->month($mon)
            ->day($day)
            ->sum('total_price');
        return $amountService;
    }

    /**
     * Doanh thu game vòng quay theo ngày tháng năm
     * @param string
     * @return int
     */
    public function doanhThuWheel($year, $mon, $day)
    {
        $amountWheel = Wheel::query()
            ->year($year)
            ->month($mon)
            ->day($day)
            ->sum('cost');
        return $amountWheel;
    }

    /*************************************************8 */
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
