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
use App\Models\NapCham;
use App\Models\UsersBuy;
use App\Models\UsersLog;
use App\Models\UsersService;
use App\Models\wheel;
use Hash;
use Session;
use Auth;


class ChargeController extends Controller
{

    /**
     * Lịch sử nạp thẻ
     * @param request
     * @return view
     */
    public function history_charge(Request $request)
    {
        $pagination = 30;
        $user_name   = $request->input('user_name');
        $number_card = $request->input('number_card');
        $card_type   = $request->input('card_type');
        $started_at  = $request->input('started_at');
        $ended_at    = $request->input('ended_at');

        // Get dữ liệu lịch sử nạp thẻ
        $data = NapCham::join('users', 'users.user_id', '=', 'nap_cham.user_id')
            ->select('nap_cham.*', 'users.name')
            ->type($card_type)
            ->card($number_card)
            ->time($started_at, $ended_at)
            ->userName($user_name)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'user_name'   => $user_name,
            'card_type'   => $card_type,
            'number_card' => $number_card,
            'started_at'  => $started_at,
            'ended_at'    => $ended_at,
        ];

        // print_r($data);
        return view('admin/charge/index', compact('data', 'dataBack'));
    }

    /**
     * update nạp thẻ
     */
    public function change_charge(Request $request)
    {

        $this->validate(
            $request,
            [
                'code' => 'required',
                'serial' => 'required',
                'amount' => 'required|integer|min:0',
            ],

            [
                'required' => ':attribute Không được để trống',
                'min' => ':attribute Không được nhỏ hơn :min',
                'integer' => ':attribute Chỉ được nhập số',
            ],

            [
                'code' => 'Mã thẻ',
                'serial' => 'Số serial',
                'amount' => 'Số tiền',
            ]
        );

        $id = $request->id;
        $telco = $request->telco;
        $code = $request->code;
        $serial = $request->serial;
        $amount = $request->amount;
        $status = $request->status;

        // dd($status);

        if ($status == 1) {
            $description = 'Nạp thẻ thành công';
        } elseif ($status == 3) {
            $description = 'Thẻ lỗi';
        }

        $arrUpdate = [
            'tel' => $telco,
            'pin' => $code,
            'serial' => $serial,
            'amount' => $amount,
        ];

        if ($status != null) {
            $arrUpdate['status'] = $status;
            $arrUpdate['desc'] = $description;
        }

        // dd($arrUpdate);

        if ($id != null) {
            NapCham::query()
                ->id($id)
                ->update($arrUpdate);
        }

        return redirect()->back()->with('message', 'Cập nhật nạp thẻ thành công');
    }

    /**
     * Xóa id nạp thẻ
     */
    public function delete_charge($id)
    {
        $data = NapCham::where('id', $id)->get();
        if (count($data) > 0) {
            NapCham::where('id', $id)->delete();
            return redirect()->back()->with('message', 'Xóa thành công!');
        }
        return redirect()->back('message', 'Xóa thất bại!');
    }

    /**
     * Xóa toàn bộ nạp thẻ
     */
    public function delete_all_charge()
    {
        NapCham::query()->truncate();
        return redirect()->route('admin.giao-dich.history_charge')->with('message', 'Xóa lịch sử thành công');
    }

    /**
     * Lịch sử dịch vụ
     * @param request
     * @return view
     */
    public function history_service(Request $request)
    {
        $pagination = 30;
        $user_name   = $request->input('user_name');
        $status      = $request->input('status');
        $trade_type = $request->input('transaction');
        $started_at  = $request->input('started_at');
        $ended_at    = $request->input('ended_at');

        // Get dữ liệu lịch sử dịch vụ
        $data = UsersService::query()
            ->join('users', 'users.user_id', '=', 'users_service.user_id')
            ->join('service_trade_type', 'service_trade_type.trade_id', '=', 'users_service.trade_type')
            ->select('users_service.*', 'users.name', 'service_trade_type.trade_name')
            ->tradeType($trade_type)
            ->status($status)
            ->time($started_at, $ended_at)
            ->userName($user_name)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'user_name'   => $user_name,
            'status'      => $status,
            'transaction' => $trade_type,
            'started_at'  => $started_at,
            'ended_at'    => $ended_at,
        ];

        // print_r($data);
        return view('admin/service/index', compact('data', 'dataBack'));
    }

    /**
     * Thao tác với đơn hàng dịch vụ
     * @param request
     * @return back
     */
    public function action_service(Request $request)
    {
        $content = $request->input('content');
        $status  = $request->input('status');
        $id      = (int) $request->input('id');

        $descStatus = '';
        switch ($status) {
            case 1:
                $descStatus = 'Chờ xác nhận';
                break;
            case 2:
                $descStatus = 'Đang xử lý';
                break;
            case 3:
                $descStatus = 'Đã hoàn thành';
                break;
            case 4:
                $descStatus = 'Đã hủy';
                break;
        }

        $arrUpdate = [
            'status' => $status,
            'desc_status' => $descStatus,
            'description' => $content,
        ];

        // update
        UsersService::query()
            ->where('id', $id)
            ->update($arrUpdate);


        return back()->with(['message' => 'Update thành công #' . $id]);
    }

    /**
     * Xóa id dịch vụ
     */
    public function delete_service($id)
    {
        $data = UsersService::query()
            ->id($id)
            ->get();
        if (count($data) > 0) {
            UsersService::query()
                ->id($id)
                ->delete();
            return redirect()->back()->with('message', 'Xóa thành công!');
        }
        return redirect()->back('message', 'Xóa thất bại!');
    }

    /**
     * Xóa toàn bộ dịch vụ
     */
    public function delete_all_service()
    {
        UsersService::query()->truncate();
        return redirect()->route('admin.giao-dich.history_service')->with('message', 'Xóa lịch sử thành công');
    }

    /**
     * Lịch sử giao dịch
     * @param request
     * @return view
     */
    public function history_transaction(Request $request)
    {
        $pagination = 10;
        $user_name   = $request->input('user_name');
        $trade_type = $request->input('transaction');
        $started_at  = $request->input('started_at');
        $ended_at    = $request->input('ended_at');

        // Get dữ liệu lịch sử dịch vụ
        $data = UsersLog::query()
            ->join('users', 'users.user_id', '=', 'users_log.user_id')
            ->join('transaction_trade_type', 'transaction_trade_type.trade_id', '=', 'users_log.trade_type')
            ->select('users_log.*', 'users.name', 'transaction_trade_type.trade_name')
            ->trade($trade_type)
            ->time($started_at, $ended_at)
            ->userName($user_name)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'user_name'   => $user_name,
            'transaction' => $trade_type,
            'started_at'  => $started_at,
            'ended_at'    => $ended_at,
        ];

        // print_r($data);
        return view('admin/transaction/index', compact('data', 'dataBack'));
    }

    /**
     * Xóa toàn bộ giao dịch
     */
    public function delete_all_transaction()
    {
        UsersLog::query()->truncate();
        return redirect()->route('admin.giao-dich.history_transaction')->with('message', 'Xóa lịch sử thành công');
    }

    /**
     * Lịch sử mua
     * @param request
     * @return view
     */
    public function history_buy(Request $request)
    {
        $pagination = 10;
        $id          = $request->input('id');
        $user_name   = $request->input('user_name');
        $game_type   = $request->input('game_type');
        $started_at  = $request->input('started_at');
        $ended_at    = $request->input('ended_at');

        // Get dữ liệu lịch sử dịch vụ
        $data = UsersBuy::query()
            ->join('users', 'users.user_id', '=', 'users_buy.user_id')
            ->join('game_type', 'game_type.game_id', '=', 'users_buy.game_type')
            ->select('users_buy.*', 'users.name', 'game_type.game_name')
            ->id($id)
            ->gameType($game_type)
            ->time($started_at, $ended_at)
            ->userName($user_name)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'id'          => $id,
            'user_name'   => $user_name,
            'game_type'   => $game_type,
            'started_at'  => $started_at,
            'ended_at'    => $ended_at,
        ];

        // print_r($data);
        return view('admin/buy/index', compact('data', 'dataBack'));
    }

    /**
     * Xóa toàn bộ mua
     */
    public function delete_all_buy()
    {
        UsersBuy::query()->truncate();
        return redirect()->route('admin.giao-dich.history_buy')->with('message', 'Xóa lịch sử thành công');
    }

    public function history_random()
    {
        $total = Wheel::count();
        $data = Wheel::join('users', 'users.user_id', '=', 'wheel_log.user_id')->orderBy('add_time', 'desc')->paginate(20);

        return view('admin/vongquay/index', compact('data', 'total'));
    }
}
