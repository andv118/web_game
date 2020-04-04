<?php

namespace App\Http\Controllers;

use App\Models\NapCham;
use Illuminate\Http\Request;
use App\Models\UsersBuy;
use App\Models\UsersGift;
use App\Models\UsersLog;
use App\Models\UsersService;
use App\Object\ObjectService;
use App\Object\ObjectTransaction;
use App\User;
use Hash;
use Auth;


class TransactionController extends Controller
{

    /**
     * View index hiển thị tất cả giao dịch
     * Search giao dịch
     * @return view
     */
    public function logTransaction(Request $request)
    {
        $pagination = 10;
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }

        $trade_type      = $request->input('trade_type');
        $started_at = $request->input('started_at');
        $ended_at   = $request->input('ended_at');
        $dataBack = [
            'trade_type' => $trade_type,
            'started_at' => $started_at,
            'ended_at'   => $ended_at,
        ];

        $transaction = new ObjectTransaction();

        // Get dữ liệu lịch sử nạp thẻ
        $userLog = UsersLog::query()
            ->user(Auth::user()['user_id'])
            ->trade($trade_type)
            ->time($started_at, $ended_at)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        // if($trade != null) {
        //     dd($userLog);
        // }
        return view('user/giaodich/transaction')->with([
            'dataLog' => $userLog,
            'dataBack' => $dataBack,
            'transaction' => $transaction,
        ]);
    }

    /**
     * View index hiển thị thẻ cào đã nạp
     * Search thẻ cào
     * @return view
     */
    public function logCard(Request $request)
    {
        $pagination = 10;
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }

        $card_type      = $request->input('card_type');
        $number_card      = $request->input('number_card');
        $started_at = $request->input('started_at');
        $ended_at   = $request->input('ended_at');
        $dataBack = [
            'card_type' => $card_type,
            'number_card' => $number_card,
            'started_at' => $started_at,
            'ended_at'   => $ended_at,
        ];

        // Get dữ liệu lịch sử nạp thẻ
        $NapchamLog = NapCham::query()
            ->user(Auth::user()['user_id'])
            ->type($card_type)
            ->card($number_card)
            ->time($started_at, $ended_at)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        // dd($NapchamLog);

        // if($trade != null) {
        //     dd($userLog);
        // }
        return view('user/giaodich/card')->with([
            'dataLog' => $NapchamLog,
            'dataBack' => $dataBack
        ]);
    }

    /**
     * View index hiển thị tài khoản đã mua
     * Search tài khoản
     * @return view
     */
    public function logAccout(Request $request)
    {
        $pagination = 10;
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }

        $id      = $request->input('id');
        $started_at = $request->input('started_at');
        $ended_at   = $request->input('ended_at');
        $dataBack = [
            'id'         => $id,
            'started_at' => $started_at,
            'ended_at'   => $ended_at,
        ];

        // Get dữ liệu lịch sử tài khoản
        $userBuy = UsersBuy::query()
            ->join('game_type', 'game_type.game_id', '=', 'users_buy.game_type')
            ->select('users_buy.*', 'game_type.game_name')
            ->user(Auth::user()['user_id'])
            ->id($id)
            ->time($started_at, $ended_at)
            ->orderBy('date', 'desc')
            ->paginate($pagination);
        // dd($NapchamLog);

        return view('user/giaodich/account')->with([
            'dataLog' => $userBuy,
            'dataBack' => $dataBack
        ]);
    }

    /**
     * View index hiển thị dịch vụ đã mua
     * Search dịch vụ
     * @return view
     */
    public function logService(Request $request)
    {
        $pagination = 10;
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }

        $id         = $request->input('id');
        $started_at = $request->input('started_at');
        $ended_at   = $request->input('ended_at');

        $service = new ObjectService();

        // Get dữ liệu lịch sử dịch vụ
        $userService = UsersService::query()
            ->user(Auth::user()['user_id'])
            ->id($id)
            ->time($started_at, $ended_at)
            ->orderBy('date', 'desc')
            ->paginate($pagination);

        $dataBack = [
            'id'         => $id,
            'started_at' => $started_at,
            'ended_at'   => $ended_at,
        ];


        return view('user/giaodich/service')->with([
            'dataLog'    => $userService,
            'dataBack'   => $dataBack,
            'service'    => $service,
        ]);
    }

    /**
     * View index hiển thị quà tặng đã mua
     * Search quà tặng
     * @return view
     */
    public function logGift(Request $request)
    {
        $pagination = 10;
        if (!Auth::check()) {
            return redirect()->route('login_user');
        }

        $id      = $request->input('id');
        $started_at = $request->input('started_at');
        $ended_at   = $request->input('ended_at');
        $dataBack = [
            'id'         => $id,
            'started_at' => $started_at,
            'ended_at'   => $ended_at,
        ];

        // Get dữ liệu lịch sử nhận quà
        $userGift = UsersGift::query()
            ->user(Auth::user()['user_id'])
            ->id($id)
            ->time($started_at, $ended_at)
            ->orderBy('date', 'desc')
            ->paginate($pagination);
        // dd($userService);

        return view('user/giaodich/gift')->with([
            'dataLog'    => $userGift,
            'dataBack'   => $dataBack
        ]);
    }
}
