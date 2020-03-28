<?php

namespace App\Http\Controllers;

use App\Models\NapCham;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\UsersLog;
use Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


class NapTheController extends Controller
{

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }
        // Get dữ liệu lịch sử nạp thẻ
        $napCham = new NapCham();
        $dataLog = $napCham->getLogNapThe(Auth::user()['user_id']);
        return view('user/napthe/index')->with([
            'dataLog' => $dataLog,
        ]);
    }

    /**
     * Callback nạp thẻ
     * @param request
     */
    public function callbackNapThe(Request $request)
    {
        $status        = $request->input('status');
        $message       = $request->input('message');
        $request_id    = $request->input('request_id');
        $value         = $request->input('value');
        $code          = $request->input('code');
        $serial        = $request->input('serial');
        $telco         = $request->input('telco');
        $callback_sign = $request->input('callback_sign');

        // ghi file
        $arr = [
            'status'        => $status,
            'message'       => $message,
            'request_id'    => $request_id,
            'value'         => $value,
            'code'          => $code,
            'serial'        => $serial,
            'telco'         => $telco,
            'callback_sign' => $callback_sign,
        ];
        Storage::put("log_callback.txt", json_encode($arr));

        if ($serial != null) {
            // get user_id
            $user_id = UsersLog::serial($serial)
                ->select('user_id')
                ->get();
            $user_id = $user_id[0]->user_id;

            // get cash
            $cash = Users::UserId($user_id)
                ->select('cash')
                ->get();
            $cash = $cash[0]->cash;
            $last_money = $cash + $value;

            // cong tien
            if ($status == 1) {
                Users::UserId($user_id)
                    ->update(['cash' => $last_money]);
            }

            // update nap cham
            NapCham::serial($serial)
                ->update(['status' => $status, 'desc' => $message]);

            // update user log
            UsersLog::serial($serial)
                ->update(['status' => $status, 'last_amount' => $last_money]);
        }

        // return back
        // if($status == 1) {
        //     $status = 'success';
        // } else {
        //     $status = 'danger';
        // }
        // return back()->with([
        //     'status' => $status,
        //     'msg'    => $message
        // ]);
    }


    /**
     * Xác nhận nạp thẻ
     * @param Request
     */
    public function submitNapThe(Request $request)
    {
        // print_r($request->input());
        $url  = config('napthe.URL_NAP_THE');
        $partnerId  = config('napthe.PARTNER_ID');
        $partnerKey = config('napthe.PARTNER_KEY');

        $data = array();
        $data['partner_id']  = $partnerId;
        $data['partner_key'] = $partnerKey;
        $data['telco']       = $request->input('telco');
        $data['code']        = $request->input('code');
        $data['serial']      = $request->input('serial');
        $data['amount']      = $request->input('amount');
        $data['request_id']  = time() . rand(10000, 99999); // tạo request id bằng chuỗi bất kỳ
        $data['command']     = 'charging';
        $sign = $data['partner_key'] . $data['code'] . $data['command'] . $data['partner_id'] . $data['request_id'] . $data['serial'] . $data['telco']; // tạo chữ ký
        $data['sign']        = md5($sign);

        // check điều kiện
        $pattern = '/^[a-zA-Z0-9]+$/';
        if (!preg_match($pattern, $data['serial']) || !preg_match($pattern, $data['code'])) {
            $msgErr = 'Mã thẻ hoặc serial không hợp lệ, thử lại nào :D';
            $notifi = 'warning';
        } elseif (!$this->checkUserLooked(Auth::user()['user_id'])) {
            $msgErr = 'Tài khoản của bạn đã bị chặn giao dịch';
            $notifi = 'error';
        } elseif (!$this->checkCardExist($data['code'], $data['serial'])) {
            $msgErr = 'Thẻ đã tồn tại trong hệ thống :)';
            $notifi = 'warning';
        } else {
            // gửi data post đến trang nạp thẻ
            $dataPost = http_build_query($data); //Tạo chuỗi truy vấn được mã hóa URL

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url); // thiết lập cấu hình post cho curl
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPost);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $result = curl_exec($ch); // nhận kết quả
            curl_close($ch); // kết thúc post data
            $result = json_decode($result);
            // dd($result);
            // xử lý kết quả trả về
            try {
                if ($result && isset($result->status)) {

                    switch ($result->status) {
                        case 1:
                            $msgErr = "Nạp thẻ thành công";
                            $notifi = 'success';
                            break;
                            // case 2:
                            //     $msgErr = "Thẻ sai mệnh giá";
                            //     $notifi = 'warning';
                            //     break;
                        case 3:
                            $msgErr = "Thẻ lỗi";
                            $notifi = 'error';
                            break;
                        case 4:
                            $msgErr = "Hệ thống bảo trì";
                            $notifi = 'error';
                            break;
                        default:
                            $msgErr = $result->message;
                            $notifi = 'warning';
                            // insert histtory to db
                            $domain = $request->root();
                            $this->insertHistory($result, $domain);
                    }
                }
            } catch (\Exception $e) {
                $msgErr = $e->getMessage();
                $notifi = 'error';
            }
        }
        // put session notification
        // session()->put('napthe-notifi',$notifi);
        // session()->put('napthe-msg',$msgErr);

        return back()->with([
            'status' => $notifi,
            'msg'    => $msgErr
        ]);
    }

    /**
     * Insert to db lịch sử nạp thẻ, thẻ trên hệ thống
     * @param json jsonResult
     */
    public function insertHistory($jsonResult, $domain)
    {
        $trade_type = 4; // trade type = 4: là nạp tiền
        if (isset($jsonResult->serial) || isset($jsonResult->code) || isset($jsonResult->amount)) {
            // insert nap cham
            $user_id = Auth::user()['user_id'];
            $arrNapCham = [
                'user_id'  => $user_id,
                'serial'   => $jsonResult->serial,
                'pin'      => $jsonResult->code,
                'tel'      => $jsonResult->telco,
                'desc'     => $jsonResult->message,
                'amount'   => $jsonResult->declared_value, // gia tri khai bao
                'fee'      => 0,
                'status'   => $jsonResult->status,
                'type'     => 0,
                'add_time' => time(),
                'trans_id' => '',
                // 'trans_id' => $jsonResult->request_id,
                'domain'   => $domain,
            ];
            NapCham::insert($arrNapCham);

            // insert users_log
            $content = "Nạp thẻ cào " . $jsonResult->telco . " có serial " . $jsonResult->serial;
            $last_amout = Users::UserId($user_id)
                ->select('cash')
                ->limit(1)
                ->get();
            $last_amout = $last_amout[0]->cash;
            $mytime = Carbon::now();
            $arrUserLog = [
                'user_id'     => $user_id,
                'trade_type'  => $trade_type,
                'action_id'   => '',
                'content'     => $content,
                'serial'      => $jsonResult->serial,
                'amount'      => $jsonResult->declared_value, // gia tri khai bao
                'last_amount' => $last_amout,
                'status'      => $jsonResult->status,
                'date'        => $mytime->toDateTimeString(),
                'add_time'    => time(),
                'domain'      => $domain,
            ];
            
            $usersLog = UsersLog::firstOrNew(['serial' => $arrUserLog['serial']]);
            $usersLog->user_id = $arrUserLog['user_id'];
            $usersLog->trade_type = $arrUserLog['trade_type'];
            $usersLog->action_id = $arrUserLog['action_id'];
            $usersLog->content = $arrUserLog['content'];
            $usersLog->serial = $arrUserLog['serial'];
            $usersLog->amount = $arrUserLog['amount'];
            $usersLog->last_amount = $arrUserLog['last_amount'];
            $usersLog->status = $arrUserLog['status'];
            $usersLog->date = $arrUserLog['date'];
            $usersLog->add_time = $arrUserLog['add_time'];
            $usersLog->domain = $arrUserLog['domain'];
            $usersLog->save();
        }
    }

    /**
     * Check tài khoản bị khóa giao dịch
     * @return boolean;
     */
    public function checkUserLooked($userId)
    {
        $userModel = new Users();
        $user = $userModel->getUser($userId);

        if ($user[0]['locked'] != 0) {
            return false;
        }
        return true;
    }

    /**
     * Check thẻ đã tồn tại trong db
     * @return boolean;
     */
    public function checkCardExist($code, $serial)
    {
        $napCham = new NapCham();
        $card = $napCham->getCardExist($code, $serial);
        $count = $card[0]['count'];
        if ($count >= 1) {
            return false;
        }
        return true;
    }
}