<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', 'UserController@getLogin');

Route::post('login', 'UserController@postLogin');

Route::get('register', 'UserController@getRegister');

Route::post('register', 'UserController@postRegister');

Route::get('forgot_password', 'Auth\ForgotPasswordController@showLinkRequestForm');

Route::post('forgot_password', 'Auth\ForgotPasswordController@sendResetLinkEmail');

Route::get('reset_password/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('reset_password', 'Auth\ResetPasswordController@reset');

Route::group(['middleware' => ['user', 'user_activated']], function() {
	Route::get('/', 'HomeController@index');

	Route::get('logout', 'UserController@getLogout');

	Route::resource('tab_member', 'TabMemberController');

	Route::get('tab_member/{tab_member_no}/generate/{type}', 'TabMemberController@generateTabMemberPdf');

	Route::get('tab_member/{tab_member_no}/generate/{type}', 'TabMemberController@generateTabMemberPdf');

	Route::post('tab_member/upload_profile_img', 'TabMemberController@uploadProfileImg');

	Route::get('tab_member/card/{tab_member_no}', 'TabMemberController@getTabMemberCard');

	Route::resource('tab_member/welfare', 'WelfareController');

	Route::get('tab_member/welfare/{tab_member_no}/create', 'WelfareController@createWelfare');

    Route::get('tab_member/welfare/{id}/print', 'WelfareController@printWelfare');

    Route::resource('service_fee', 'ServiceFeeController');

    Route::get('tab_member/service_fee/{tab_member_no}', 'ServiceFeeController@getServiceFee');

    Route::get('tab_member/service_fee/{tab_member_no}/create', 'ServiceFeeController@createServiceFee');

	Route::get('report', 'ReportController@getReport');

	Route::post('member_report', 'ReportController@getMemberReport');

	Route::get('update_user', 'UserController@getUserBySession');

	Route::post('manage_user/update', 'UserController@updateUser');

    Route::get('show_user', 'UserController@show');

	Route::group(['middleware' => 'admin'], function() {
		Route::get('manage_user', 'UserController@getManageUser');

		Route::get('manage_user/activate/{user_id}', 'UserController@getActivateUser');

		Route::get('manage_user/create', 'UserController@getCreateUserPage');

		Route::get('manage_user/edit/{user_id}', 'UserController@getUser');

		Route::get('manage_user/delete/{user_id}', 'UserController@softDelete');

        Route::get('import', 'Reportcontroller@getImport');

        Route::post('import', 'Reportcontroller@importReport');

        Route::resource('video_tutorial', 'TutorialVideoController');
	});

	//============= API ===========//

	Route::get('api/update_province_by_geography/{geography_id}', 'ThailandDataController@updateProvinceByGeography');

	Route::get('api/update_district_by_province/{province_id}', 'ThailandDataController@updateDistrictByProvince');

	Route::get('api/update_sub_district_by_district/{district_id}', 'ThailandDataController@updateSubDistrictByDistrict');

	Route::get('api/update_zipcode_by_sub_district/{sub_district_id}', 'ThailandDataController@updateZipcodeBySubDistrict');
});
