<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\UsersLog;
use App\Models\UsersBuy;
use App\Models\Random;
use Session;
use Auth;


class RandomController extends Controller
{

	public function index($type, Request $req)
	{

		$category = $type;

		if ($category == 'all') {

			$title = "THỬ VẬN MAY NGỌC RỒNG 20K";

			$data = Random::where('type', 'Random Ngọc Rồng')->where('cost',20000)->where('status', 0)->orderBy('add_time', 'desc')->paginate(20);
		} elseif ($category == 'tam-trung') {

			$title = "THỬ VẬN MAY NGỌC RỒNG 50K";

			$data = Random::where('type', 'Random Ngọc Rồng')->where('status', 0)->where('cost', 50000)->paginate(20);
		} else {

			return redirect()->back();
		}

		return view('user/random/index', compact('data', 'title'));
	}

	public function buyAcc($id)
	{

		$data = Random::where('id', $id)->get()->toArray();


		return view('user/random/buy', compact('data'));
	}

	public function saveRandom(Request $request)
	{	

		$id = $request->input('id');

		// check so tien
		$cost = 20000;
		$userCash = Auth::user()->cash;
		if($userCash < $cost) {
			return redirect()->back()->with('error', 'Số tiền không đủ');
		}

		$data = Random::where('id', $id)->get()->toArray();

		Random::where('id', $id)->update(['status' => 1]);

		$cash = Auth::user()->cash - (int) $data[0]['cost'];

		Users::where('id', Auth::user()->id)->update(['cash' => $cash]);

		$log = new UsersLog();
		$log->user_id = Auth::user()->user_id;
		$log->trade_type = "Mua tài khoản";
		$log->amount = $data[0]['cost'];
		$log->content = 'Mua tài khoản ' . $data[0]['type'] . ' #' . $id;
		$log->last_amount = $cash;
		$log->trade_type = 5;
		$log->status = 1;
		$log->add_time = time();
		$log->domain = 'sh0phano.com';
		$log->save();


		// lịch sử mua acc của người mua
		$user = new UsersBuy();
		$user->user_id = Auth::user()->user_id;
		$user->type = $data[0]['category'];
		$user->cost = $data[0]['cost'];
		$user->desc = $data[0]['type'] . ' #' . $id;
		$user->info = $data[0]['info'];
		echo $log->id . '<br>';
		$user->status = 1;
		$user->game_type = 3;
		$user->add_time = time();
		$user->domain = 'sh0phano.com';
		$user->save();

		return redirect()->back()->with('message', $data[0]['info']);
	}
}
