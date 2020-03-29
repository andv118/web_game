<?php

Route::get('/test', 'BaseController@test'); //Trang chủ


//------------------------- Giao diện người dùng-------------------------------------
Route::get('/', 'BaseController@index')->name('index'); //Trang chủ
Route::get('login', 'BaseController@login')->name('login'); //Trang đăng nhập
Route::post('login', 'UserController@login_user')->name('login_user'); //Đăng nhập tài khoản user
Route::get('/register', 'BaseController@register')->name('register'); //Trang đăng ký
Route::post('/register', 'UserController@register_user')->name('register_user'); //Đăng ký tài khoản user
Route::get('/logout', 'UserController@logout_user')->name('logout_user'); //Đăng xuất tài khoản user
Route::get('/logout', 'UserController@logout_user')->name('logout_user'); //Đăng xuất tài khoản user
Route::get('/nap-the', 'BaseController@nap_the')->name('nap_the'); //Nạp thẻ cào
Route::get('/profile', 'BaseController@profile')->name('profile'); //Trang profile cá nhân

Route::get('/login/facebook/facebook', 'SocialController@redirect')->name('login_facebook');
Route::get('/callback/facebook', 'SocialController@callback');

Route::get('/nap-the', 'NapTheController@index')->name('nap_the'); // Nạp thẻ
Route::post('/xac-nhan-nap-the', 'NapTheController@submitNapThe')->name('xac_nhan_nap_the'); // Xác nhận nạp thẻ
Route::get('/nap-the-callback', 'NapTheController@callbackNapThe'); // Nạp thẻ

Route::get('/nap-tien-atm', 'NapTheController@nap_ATM')->name('nap_atm'); // Nạp ATM

//------------------DANH MỤC GAME: Ngọc Rồng----------------
Route::get('/ngoc-rong/{param}', 'GameController@ngoc_rong')->name('ngoc_rong'); //show
Route::get('/ngoc-rong/chi-tiet/{id}', 'GameController@chi_tiet_ngoc_rong')->name('chi_tiet_ngoc_rong'); //chi tiết ngọc rồng
Route::post('/ngoc-rong/thanh-toan', 'GameController@thanh_toan_ngoc_rong')->name('pay_ngoc_rong'); //pay


//------------------Dịch vụ game - Transaction----------------
Route::group(['prefix' => 'dich-vu', 'as' => 'dichvu.'], function () { // dich vu
	Route::group(['prefix' => 'ngoc-rong', 'as' => 'ngocrong.'], function () {
		Route::get('/', 'BaseController@dich_vu_ngoc_rong')->name('index'); //Trang dich vụ ngọc rồng
		Route::get('/ban-vang', 'ServiceController@ban_vang')->name('ban-vang'); //Trang dich vụ ngọc rồng bán vàng
		Route::post('/ban-vang-pay', 'ServiceController@ban_vang_pay')->name('ban-vang-pay'); //Trang dich vụ ngọc rồng bán vàng
		Route::get('/ban-ngoc', 'ServiceController@ban_ngoc')->name('ban-ngoc'); //bán ngoc
		Route::post('/ban-ngoc-pay', 'ServiceController@ban_ngoc_pay')->name('ban-ngoc-pay'); //thanh toan
		Route::get('/lam-nhiem-vu', 'ServiceController@nhiem_vu')->name('nhiem-vu'); //bán ngoc
		Route::post('/lam-nhiem-vu-pay', 'ServiceController@nhiem_vu_pay')->name('nhiem-vu-pay'); //thanh toan
		Route::get('/up-bi-kip', 'ServiceController@bi_kip')->name('bi-kip'); //bán ngoc
		Route::post('/up-bi-kip-pay', 'ServiceController@bi_kip_pay')->name('bi-kip-pay'); //thanh toan
		Route::get('/up-suc-manh-su-phu', 'ServiceController@su_phu')->name('su-phu'); //bán ngoc
		Route::post('up-suc-manh-su-phu-pay', 'ServiceController@su_phu_pay')->name('su-phu-pay'); //thanh toan
		Route::get('/up-suc-manh-de-tu', 'ServiceController@de_tu')->name('de-tu'); //bán ngoc
		Route::post('up-suc-manh-de-tu-pay', 'ServiceController@de_tu_pay')->name('de-tu-pay'); //thanh toan
		Route::get('/san-de-tu', 'ServiceController@san_de_tu')->name('san-de-tu'); //bán ngoc
		Route::post('san-de-tu-pay', 'ServiceController@san_de_tu_pay')->name('san-de-tu-pay'); //thanh toan
	});
});

// ------------------Giao dịch người dùng - Transaction----------------
Route::group(['prefix' => 'giao-dich', 'as' => 'giao-dich.'], function () {
	Route::group(['prefix' => 'lich-su', 'as' => 'lich-su.'], function () {
		Route::get('/', 'TransactionController@logTransaction')->name('index'); //Lịch sử giao dịch
		Route::get('/search', 'TransactionController@logTransaction')->name('search'); //Search lịch sử giao dịch
	});
	Route::group(['prefix' => 'the-cao', 'as' => 'the-cao.'], function () {
		Route::get('/', 'TransactionController@logCard')->name('index'); //Lịch sử giao dịch
		Route::get('/search', 'TransactionController@logCard')->name('search'); //Search lịch sử giao dịch
	});
	Route::group(['prefix' => 'tai-khoan', 'as' => 'tai-khoan.'], function () {
		Route::get('/', 'TransactionController@logAccout')->name('index'); //Lịch sử giao dịch
		Route::get('/search', 'TransactionController@logAccout')->name('search'); //Search lịch sử giao dịch
	});
	Route::group(['prefix' => 'dich-vu', 'as' => 'dich-vu.'], function () {
		Route::get('/', 'TransactionController@logService')->name('index'); //Lịch sử giao dịch
		Route::get('/search', 'TransactionController@logService')->name('search'); //Search lịch sử giao dịch
	});

	Route::group(['prefix' => 'qua-tang', 'as' => 'qua-tang.'], function () {
		Route::get('/', 'TransactionController@logGift')->name('index'); //Lịch sử giao dịch
		Route::get('/search', 'TransactionController@logGift')->name('search'); //Search lịch sử giao dịch
	});
});

// ------------------Vòng quay - Wheel----------------
Route::get('vong-quay', 'WheelController@index')->name('vong_quay');//Vòng quay may mắn nick vip 50k
Route::post('load-vong-quay', 'WheelController@load')->name('load_vong_quay');//Load vòng quay may mắn nick vip 50k
Route::post('mua-vong-quay', 'WheelController@buy')->name('buy_vong_quay');//Mua vòng quay may mắn nick vip 50k

Route::get('vong-quay-vang-50k', 'WheelController@wheel50')->name('vong_quay_vang_50k');//Vòng quay may mắn 50k
Route::post('load-vong-quay-50k', 'WheelController@load50')->name('load_vong_quay_50k');//Load vòng quay may mắn 50k
Route::post('mua-vong-quay-vang-50k', 'WheelController@buy50')->name('buy_vong_quay_50k');//Mua vòng quay may mắn 50k

Route::get('vong-quay-vang-20k', 'WheelController@wheel20')->name('vong_quay_vang_20k');//Vòng quay may mắn 20k
Route::post('load-vong-quay-20k', 'WheelController@load20')->name('load_vong_quay_20k');//Load vòng quay may mắn 20k
Route::post('mua-vong-quay-vang-20k', 'WheelController@buy20')->name('buy_vong_quay_20k');//Mua vòng quay may mắn 20k

// ------------------Random ngọc rồng ----------------
Route::group(['prefix' => 'random-ngoc-rong', 'as' => 'random.'], function () {
	Route::get('/{type}', 'RandomController@index')->name('index'); //Trang chủ random ngọc rồng
	Route::post('buy-random', 'RandomController@saveRandom')->name('buy_acc'); //Mua random ngọc rồng
});


// ------------------Authentication-----------------------------
Route::get('/admin', 'AdminController@login')->name('login_admin')->middleware('checkLogout');
Route::post('/login-admin', 'AdminController@getLogin')->name('getLogin');
Route::get('logout-admin', 'AdminController@Logout')->name('logout_admin');


//-------------------Admin-----------------------------------------
Route::group(['prefix' => 'quan-tri', 'as' => 'admin.', 'middleware' => ['checkLogin']], function () {

	//-----------------------------Trang chủ------------------
	Route::get('trang-chu', 'HomeController@Home')->name('home');

	//-----------------------------Quản lý người dùng---------- 
	Route::get('/danh-sach-tai-khoan', 'HomeController@ManageUsers')->name('manage-users');
	Route::get('/them-moi-tai-khoan', 'HomeController@CreateUsers')->name('create-users');
	Route::post('/luu-tai-khoan', 'HomeController@SaveUsers')->name('save-users');
	Route::get('/xoa-tai-khoan/{id}', 'HomeController@DeleteUsers')->name('delete-users');
	Route::get('/sua-tai-khoan/{id}', 'HomeController@UpdateUsers')->name('update-users');
	Route::post('/sua-tai-khoan', 'HomeController@ChangeUsers')->name('change-users');
	Route::get('/reset-tai-khoan', 'HomeController@ResetAmountUser')->name('reset-users');

	//------------------------------Phân Quyền-------------------
	Route::get('/phan-quyen', 'AdminController@roles')->name('roles');
	Route::get('/cap-nhat-phan-quyen/{id}', 'AdminController@update_roles')->name('update_roles');

	//------------------------------Cài đặt website-------------------
	Route::get('cai-dat-website', 'AdminController@settings')->name('settings');
	Route::post('luu-cai-dat-website', 'AdminController@save_settings')->name('save_settings');

	//------------------------------Quản lý danh mục-------------------
	Route::get('quan-ly-danh-muc', 'AdminController@danhmuc')->name('danhmuc');
	Route::post('update-danh-muc', 'AdminController@update_danhmuc')->name('update_danhmuc');


	//---------------------------------Quản lý slides------------------
	Route::get('quan-ly-slides', 'AdminController@slideshow')->name('slideshow');
	Route::post('cap-nhat-slides', 'AdminController@update_slide')->name('update_slide');
	Route::post('them-moi-slides', 'AdminController@save_slide')->name('save_slide');
	Route::get('xoa-slide', 'AdminController@delete_slide')->name('delete_slide');

	//----------------------------Tài khoản game------------------
	Route::get('tai-khoan-ngoc-rong', 'GameController@tk_ngocrong')->name('tk_ngocrong');
	Route::get('xoa-ngoc-rong/{id}', 'GameController@delete_ngocrong')->name('delete_ngocrong');
	Route::post('them-ngoc-rong', 'GameController@add_ngocrong')->name('add_ngocrong');
	Route::post('sua-ngoc-rong', 'GameController@change_ngocrong')->name('change_ngocrong');

	Route::get('tai-khoan-pubg', 'GameController@tk_pubg')->name('tk_pubg');
	Route::get('tai-khoan-lien-quan', 'GameController@tk_lienquan')->name('tk_lienquan');
	Route::get('tai-khoan-freefire', 'GameController@tk_freefire')->name('tk_freefire');

	Route::get('tai-khoan-random', 'RandomController@tk_random')->name('tk_random');
	Route::post('them-tai-khoan-random', 'RandomController@create_random')->name('create_random');
	Route::post('sua-tai-khoan-random', 'RandomController@update_random')->name('update_random');
	Route::get('xoa-khoan-random/{id}', 'RandomController@delete_random')->name('delete_random');

	//----------------------------Giao dịch game------------------
	Route::group(['prefix' => 'giao-dich', 'as' => 'giao-dich.'], function () {
		Route::get('lich-su-nap-the', 'ChargeController@history_charge')->name('history_charge');
		Route::post('thao-tac-nap-the', 'ChargeController@change_charge')->name('change_charge');
		Route::get('xoa-nap-the/{id}', 'ChargeController@delete_charge')->name('delete_charge');
		Route::post('xoa-all-nap-the', 'ChargeController@delete_all_charge')->name('delete_all_charge');

		Route::get('lich-su-dich-vu', 'ChargeController@history_service')->name('history_service');
		Route::post('thao-tac-dich-vu', 'ChargeController@action_service')->name('action_service');
		Route::get('xoa-dich-vu/{id}', 'ChargeController@delete_service')->name('delete_service');
		Route::post('xoa-all-dich-vu', 'ChargeController@delete_all_service')->name('delete_all_service');

		Route::get('lich-su-giao-dich', 'ChargeController@history_transaction')->name('history_transaction');
		Route::post('xoa-all-giao-dich', 'ChargeController@delete_all_transaction')->name('delete_all_transaction');

		Route::get('lich-su-mua', 'ChargeController@history_buy')->name('history_buy');
		Route::post('xoa-all-lich-su-mua', 'ChargeController@delete_all_buy')->name('delete_all_buy');

		Route::get('lich-su-quay', 'ChargeController@history_whell')->name('history_whell');
	});
});
