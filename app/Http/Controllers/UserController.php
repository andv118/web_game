<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Hash;
use Session;
use Auth;


class UserController extends Controller
{

    public function login_user(Request $request){
        $this->validate($request,[
            'username'=>'required',
            'password'=>'required|min:5|max:20'
        ],
        [
            'username'=>'Hãy nhập mã cán bộ hoặc email',
            'password.min'=>'Mật khẩu tối đa 5 ký tự',
            'password.max'=>'Mật khẩu không quá 20 ký tự'
        ]);

        $check = array('name'=>$request->username,'password'=>$request->password);
        $check2 = array('email'=>$request->username,'password'=>$request->password);

        if(Auth::attempt($check) || Auth::attempt($check2)){
            Session::put('user_id',Auth::user()->id.'_'.Auth::user()->user_id);
            return redirect()->route('index');

        }else{

           return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập thất bại. Sai tài khoản hoặc mật khẩu']);

        }   
    }



     public function register_user(Request $req){
        $this->validate($req,[
            'email'=>'email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'username'=>'required',
            'phone'=>'required|unique:users,user_phone',
            'password_confirmation'=>'required|same:password'
            
        ],
        [
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã thuộc về 1 tài khoản',
            'username.required'=>'Hãy nhập tên đăng nhập',
            'password.min'=>'Mật khẩu tối đa 6 ký tự',
            'password.max'=>'Mật khẩu không quá 20 ký tự',
            'password.required'=>'Mật khẩu không không được để trống',
            'password_confirmation.same'=>'Mật khẩu không khớp',
            'password_confirmation.required'=>'Hãy nhập lại mật khẩu',
            'phone.required'=>'Hãy nhập số điện thoại',
            'phone.unique'=>'Số điện thoại đã thuộc về 1 tài khoản'
          
        ]);

        function generateRandomString($length = 10) {
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
        $user->user_id = generateRandomString(rand(9,15));
        $user->email = $req->email;
        $user->user_phone = $req->phone;
        $user->password = bcrypt($req->password);
        $user->user_agent = $_SERVER["HTTP_USER_AGENT"];
        $user->last_time = time();
        $user->save();

        return redirect()->back()->with('thanhcong','Tạo tài khoản thành công');
    }



    public function Login(){

    	return view('users/login');
    }

    public function getLogin(Request $request){
    	$this->validate($request,[
            'username'=>'required',
            'password'=>'required|min:5|max:20'
        ],
        [
            'username'=>'Hãy nhập mã cán bộ hoặc email',
            'password.min'=>'Mật khẩu tối đa 5 ký tự',
            'password.max'=>'Mật khẩu không quá 20 ký tự'
        ]);

        $check = array('email'=>$request->username,'password'=>$request->password);
        $check2 = array('code'=>$request->username,'password'=>$request->password);

        if(Auth::attempt($check)||Auth::attempt($check2)){
            Session::put('userid',Auth::user()->id);
            Session::put('username',Auth::user()->name);
            Session::put('usercode',Auth::user()->code);
            Session::put('userrole',Auth::user()->role);
            return redirect()->route('admin.home');

        }else{

           return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập thất bại. Sai tài khoản hoặc mật khẩu']);

        }   
    }

     public function Logout(){
    	Auth::logout();
    	Session::forget('userid');
    	Session::forget('username');
        Session::forget('usercode');
    	return redirect()->route('login');
    }

    public function logout_user(){
        Auth::logout();
        Session::forget('user_id');
        return redirect()->route('index');
    }
}
