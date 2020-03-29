<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Users;
use App\Models\UsersLog;
use App\Models\UsersBuy;
use App\Models\Random;
use App\Object\GameRandom;
use Session;
use Auth;


class RandomController extends Controller
{

	public function index($type, Request $req)
	{

		$category = $type;

		if ($category == 'all') {

			$title = "THỬ VẬN MAY NGỌC RỒNG 20K";

			$data = Random::where('type', 'Random Ngọc Rồng')->where('cost', 20000)->where('status', 0)->orderBy('add_time', 'desc')->paginate(20);
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
		if ($userCash < $cost) {
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


	/*********************** Random Admin ***************/
	public function tk_random(Request $request)
	{
		$pagination = 30;

		$random = new GameRandom();

		$id = $request->input('id');
		$infor = $request->input('infor');
		$user_post = $request->input('user_post');
		$status = $request->input('status');
		$type = $request->input('type');
		$total = Random::count();

		// dd($type);

		$data = Random::leftJoin('users', 'users.user_id', '=', 'random.user_post_id')
			->select('random.*', 'users.name')
			->id($id)
			->status($status)
			->infor($infor)
			->CTV($user_post)
			->type($type)
			->orderBy('id', 'desc')
			->paginate($pagination);

		$dataBack = [
			'id'        => $id,
			'infor'     => $infor,
			'user_post' => $user_post,
			'status'    => $status,
			'type'      => $type,
		];

		// dd($dataBack);
		return view('admin/random/index', compact('dataBack', 'total', 'random', 'data'));
	}

	public function create_random(Request $request)
	{
		$this->validate(
			$request,
			[
				'type' => 'required',
				'category' => 'required',
				'infor' => 'required',
			],

			[
				'required' => ':attribute Không được để trống',
			],

			[
				'type' => 'Danh mục',
				'category' => 'Loại',
				'infor' => 'Tài khoản',
			]
		);

		$arrCost = [
			0 => [20000, 50000, 100000],
			1 => [10000, 50000, 100000],
			2 => [10000, 50000, 100000],
			3 => [10000, 50000, 100000],
			4 => [10000, 50000, 100000],
			5 => [10000, 50000, 100000],
		];

		$arrCategory = [
			0 => ['Vận May Ngọc Rồng 20K', 'Vận May Ngọc Rồng 50K', 'Vận May Ngọc Rồng 100K'],
			1 => ['Vận May Liên Quân 10K', 'Vận May Liên Quân 50K', 'Vận May Liên Quân 100K'],
			2 => ['Vận May Free Fire 10K', 'Vận May Free Fire 50K', 'Vận May Free Fire 100K'],
			3 => ['Vận May PUBG 10K', 'Vận May PUBG 50K', 'Vận May PUBG 100K'],
		];

		$user_id = Auth::user()->user_id;
		$status = 0;
		$type = $request->input('type');
		$infor = $request->input('infor');
		$intCategory = $request->input('category');
		$arrInfor = preg_split('/\r\n|[\r\n]/', $infor);

		// get category
		$category = '';
		foreach ($arrCategory[$type] as $k => $v) {
			if ($intCategory == $k) {
				$category = $v;
			}
		}

		// get cost
		$cost = $arrCost[$type][$intCategory];
		$cost_atm = (int) round(($cost * 80) / 100);

		foreach ($arrInfor as $infor) {
			if ($infor != null) {
				$random = new Random();
				$random->user_post_id = $user_id;
				$random->type = $type;
				$random->info = $infor;
				$random->cost = $cost;
				$random->cost_atm = $cost_atm;
				$random->status = $status;
				$random->add_time = time();
				$random->category = $category;
				$random->save();
			}
		}
		return redirect()->back()->with('message', 'Thêm tài khoản thành công!');
	}

	public function update_random(Request $request)
	{
		// dd($request->input());

		$arrCost = [
			0 => [20000, 50000, 100000],
			1 => [10000, 50000, 100000],
			2 => [10000, 50000, 100000],
			3 => [10000, 50000, 100000],
			4 => [10000, 50000, 100000],
			5 => [10000, 50000, 100000],
		];

		$arrCategory = [
			0 => ['Vận May Ngọc Rồng 20K', 'Vận May Ngọc Rồng 50K', 'Vận May Ngọc Rồng 100K'],
			1 => ['Vận May Liên Quân 10K', 'Vận May Liên Quân 50K', 'Vận May Liên Quân 100K'],
			2 => ['Vận May Free Fire 10K', 'Vận May Free Fire 50K', 'Vận May Free Fire 100K'],
			3 => ['Vận May PUBG 10K', 'Vận May PUBG 50K', 'Vận May PUBG 100K'],
		];

		$id          = $request->input('id');
		$type        = $request->input('type');
		$infor       = $request->input('infor');
		$intCategory = $request->input('category');

		// get category
		$category = '';
		foreach ($arrCategory[$type] as $k => $v) {
			if ($intCategory == $k) {
				$category = $v;
			}
		}

		// get cost
		$cost = $arrCost[$type][$intCategory];
		$cost_atm = (int) round(($cost * 80) / 100);

		$arrUpdate = [
			'type' => $type,
			'info' => $infor,
			'cost' => $cost,
			'cost_atm' => $cost_atm,
			'category' => $category,
		];

		if ($id != null) {
			Random::query()
				->id($id)
				->update($arrUpdate);
		}

		// dd($arrInsert);
		return redirect()->back()->with('message', 'Cập nhật tài khoản thành công!');
	}

	public function delete_random($id)
	{
		$data = Random::where('id', $id)->get();
		if (count($data) > 0) {
			Random::where('id', $id)->delete();
			return redirect()->back()->with('message', 'Xóa thành công!');
		}
		return redirect()->back('message', 'Xóa thất bại!');
	}
}
