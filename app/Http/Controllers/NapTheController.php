<?php

namespace App\Http\Controllers;

use App\Models\NapCham;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\UsersLog;
use Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class NapTheController extends Controller
{

    protected $user_id = null;
    protected $domain = null;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user_id = session()->get('user_id');
            $this->domain = $request->root();
            return $next($request);
        });
    }

    public function index()
    {   
        
        // Get dữ liệu lịch sử nạp thẻ
        $panigate = 10;
        $dataLog = NapCham::where('user_id', '=', $this->user_id)->orderBy('date', 'desc')
            ->paginate($panigate);

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
        $time = Carbon::now();
        
        $arr = [
            'time' => $time->toDateString() . '-' . $time->toTimeString(),
            'status'        => $status,
            'message'       => $message,
            'request_id'    => $request_id,
            'value'         => $value,
            'code'          => $code,
            'serial'        => $serial,
            'telco'         => $telco,
            'callback_sign' => $callback_sign,
        ];

        Storage::put("log_callback.txt", json_encode($arr, JSON_UNESCAPED_UNICODE));

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
            $notifi = 'danger';
        } elseif (!$this->checkUserLooked()) {
            $msgErr = 'Tài khoản của bạn đã bị chặn giao dịch';
            $notifi = 'danger';
        } elseif (!$this->checkCardExist($data['code'], $data['serial'])) {
            $msgErr = 'Thẻ đã tồn tại trong hệ thống :)';
            $notifi = 'danger';
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
                            $notifi = 'danger';
                            break;
                        case 4:
                            $msgErr = "Hệ thống bảo trì";
                            $notifi = 'danger';
                            break;
                        default:
                            $msgErr = $result->message;
                            $notifi = 'warning';
                            // insert histtory to db
                            $this->insertHistory($result);
                    }
                }
            } catch (Exception $e) {
                $msgErr = $e->getMessage();
                $notifi = 'danger';
            }
        }

        return back()->with(['status' => $notifi, 'msg' => $msgErr]);
    }

    /**
     * Insert to db lịch sử nạp thẻ, thẻ trên hệ thống
     * @param json jsonResult
     */
    public function insertHistory($jsonResult)
    {   
        $trade_type = 4; // trade type = 4: là nạp tiền
        if (isset($jsonResult->serial) || isset($jsonResult->code) || isset($jsonResult->amount)) {
            // insert nap cham
            $napCham = NapCham::firstOrNew(['serial' => $jsonResult->serial]);
            $napCham->user_id     = $this->user_id;
            $napCham->serial      = $jsonResult->serial;
            $napCham->pin         = $jsonResult->code;
            $napCham->tel         = $jsonResult->telco;
            $napCham->desc        = $jsonResult->message;
            $napCham->amount      = $jsonResult->declared_value;
            $napCham->fee         = 0;
            $napCham->status      = $jsonResult->status;
            $napCham->type        = 0;
            $napCham->add_time    = time();
            $napCham->trans_id    = '';
            // $napCham->trans_id    = $jsonResult->request_id;
            $napCham->domain      = $this->domain;
            $napCham->save();

            // insert users_log
            $content = "Nạp thẻ cào " . $jsonResult->telco . " có serial " . $jsonResult->serial;
            $last_amout = Users::UserId($this->user_id)->select('cash')->first()->cash;
          
            $usersLog = UsersLog::firstOrNew(['serial' => $jsonResult->serial]);
            $usersLog->user_id     = $this->user_id;
            $usersLog->trade_type  = $trade_type;
            $usersLog->action_id   = '';
            $usersLog->content     = $content;
            $usersLog->serial      = $jsonResult->serial;
            $usersLog->amount      = $jsonResult->declared_value;
            $usersLog->last_amount = $last_amout;
            $usersLog->status      = $jsonResult->status;
            $usersLog->add_time    = time();
            $usersLog->domain      = $this->domain;
            $usersLog->save();
        }
    }

    /**
     * Check tài khoản bị khóa giao dịch
     * @return boolean;
     */
    public function checkUserLooked()
    {
        if ($this->user_id != null) {
            $lock = Users::where([['user_id', '=', $this->user_id], ['locked', '=', 1]])->count();
            if ($lock != 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Check thẻ đã tồn tại trong db
     * @return boolean;
     */
    public function checkCardExist($code, $serial)
    {
        $card = NapCham::where('serial', '=', $serial)->orWhere('pin', '=', $code)->count();
        if ($card > 0) {
            return false;
        }
        return true;
    }
}
