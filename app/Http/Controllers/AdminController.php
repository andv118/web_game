<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Settings;
use App\Models\Slides;
use App\Models\Danhmuc;
use App\Models\Ngocrong;
use Hash;
use Session;
use Auth;


class AdminController extends Controller
{
    public function roles(Request $req)
    {

        $pagination = 30;
        $keyword = $req->input('keyword');
        $title = "Danh sách tài khoản";
        $admin = 1;

        $total = Users::query()
            ->userAdmin($admin)
            ->keyword($keyword)
            ->count();

        $data = Users::query()
            ->userAdmin($admin)
            ->keyword($keyword)
            ->paginate($pagination);

        $dataBack = [
            'keyword'   => $keyword,
        ];

        return view('admin/roles/index', compact('data', 'total', 'title'));
    }

    public function update_roles(Request $req, $id)
    {

        $data = Users::where('id', $id)->get();
        if (count($data) > 0) {
            Users::where('id', $id)->update(['is_admin' => $req->role]);
            return redirect()->back()->with('message', 'Cập nhật thành công');
        }
        return redirect()->back();
    }


    public function settings(Request $req)
    {

        $settings = Settings::all()->toArray();
        $data = [];
        foreach ($settings as  $value) {
            $data[] = $value['value'];
        }

        return view('admin/settings/index', compact('data'));
    }

    public function save_settings(Request $req)
    {

        $data = [];

        $request = $req->post();

        foreach ($request as $key => $value) {

            if ($key != '_token') {

                Settings::where('key', $key)->update(['value' => $value]);
            }
        }

        return redirect()->back()->with('success-update', 'Cập nhật thành công !');
    }

    public function danhmuc(Request $req)
    {

        $data = Danhmuc::all();
        return view('admin/danhmuc/index', compact('data'));
    }


    public function update_danhmuc(Request $req)
    {

        $id = $req->id;
        $data = Danhmuc::where('id', $id)->take(1)->get()->toArray();
        if (count($data) > 0) {
            $tt = $data[0]['stt'];
            if ($tt == 1) {

                Danhmuc::where('id', $id)->update(['stt' => 0]);
            } else {

                Danhmuc::where('id', $id)->update(['stt' => 1]);
            }
        }
    }

    public function slideshow()
    {

        $total = Slides::count();
        $data = Slides::paginate(10);
        return view('admin/slides/index', compact('data', 'total'));
    }

    public function delete_slide(Request $req)
    {

        if ($req->id && $req->id != '') {

            $image = Slides::where('id', $req->id)->take(1)->get()->toArray();

            if (count($image) > 0) {

                $path = 'public/client/assets/images/' . $image[0]['image'];

                unlink($path);

                Slides::where('id', $req->id)->delete();

                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }


    public function update_slide(Request $req)
    {

        $id = $req->id;
        $data = Slides::where('id', $id)->take(1)->get()->toArray();
        if (count($data) > 0) {
            $tt = $data[0]['tt'];
            if ($tt == 1) {

                Slides::where('id', $id)->update(['tt' => 0]);
            } else {

                Slides::where('id', $id)->update(['tt' => 1]);
            }
        }
    }

    public function save_slide(Request $rq)
    {

        $fileExtension = $rq->file('image')->getClientOriginalExtension(); // Lấy tên của file

        // Filename cực shock để khỏi bị trùng
        $fileName = time() . "_" . rand(0, 9999999) . "_" . md5(rand(0, 9999999)) . "." . $fileExtension;

        // Thư mục upload
        $uploadPath = public_path('client\assets\images');

        // Bắt đầu chuyển file vào thư mục
        $rq->file('image')->move($uploadPath, $fileName);

        $data = new Slides();
        $data->image = $fileName;
        $data->title = $rq->title;
        $data->link = $rq->link;
        $data->tt = 1;
        $data->save();

        // Thành công, show thành công
        return redirect()->back()->with('success-save', 'Thêm mới thành công!');
    }


    public function tk_ngocrong()
    {

        $data = [];
        $total = Ngocrong::count();
        $ngocrong = Ngocrong::paginate(20);
        foreach ($ngocrong as $value) {
            $user_id = $value->user_post_id;

            $user = $this->getUserInfo($user_id);
            $array = [
                'id' => $value->id,
                'info' => $value->info,
                'user_name' => $user[0]['name'],
                'user_email' => $user[0]['email'],
                'user_phone' => $user[0]['user_phone'],
                'user_id' => $user[0]['user_id'],
                'dk' => $value->dk,
                'cost' => $value->cost,
                'status' => $value->status

            ];

            $data[] = $array;
        }

        return view('admin/ngocrong/index', compact('data', 'total', 'ngocrong'));
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



    public function login()
    {

        return view('admin/authentication/login');
    }

    public function getLogin(Request $request)
    {
        $this->validate(
            $request,
            [
                'username' => 'required',
                'password' => 'required|min:5|max:20'
            ],
            [
                'username' => 'Hãy nhập mã cán bộ hoặc email',
                'password.min' => 'Mật khẩu tối đa 5 ký tự',
                'password.max' => 'Mật khẩu không quá 20 ký tự'
            ]
        );

        $check = array('email' => $request->username, 'password' => $request->password);
        $check2 = array('name' => $request->username, 'password' => $request->password);

        if (Auth::attempt($check) || Auth::attempt($check2)) {
            if (Auth::user()->is_admin == 1) {
                Session::put('admin_id', Auth::user()->user_id);
                Session::put('admin_name', Auth::user()->name);
                return redirect()->route('admin.home');
            } else {

                return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập thất bại. Sai tài khoản hoặc mật khẩu']);
            }
        } else {

            return redirect()->back()->with(['flag' => 'danger', 'message' => 'Đăng nhập thất bại. Sai tài khoản hoặc mật khẩu']);
        }
    }

    public function Logout()
    {
        Session::forget('admin_id');
        Session::forget('admin_name');
        return redirect()->route('login_admin');
    }
}
