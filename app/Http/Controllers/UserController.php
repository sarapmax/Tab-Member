<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function getLogin() {
    	if(auth()->guard('user')->check()) {
    		return redirect('/');
    	}

    	return view('login');
    }

    public function getRegister() {
    	if(auth()->guard('user')->check()) {
    		return redirect('/');
    	}

    	return view('register');
    }

    public function getForgotPassword() {
    	if(auth()->guard('user')->check()) {
    		return redirect('/');
    	}

    	return view('forgot_password');
    }

    public function postRegister(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|email|unique:users',
    		'password' => 'required|min:5|confirmed',
    		'password_confirmation' => 'required',
    		'firstname' => 'required',
    		'lastname' => 'required',
    		'phone_number' => 'required|alpha_num|digits:10',
    		'branch' => 'required',
            'admin' => 'required',
            'active' => 'required',
    	]);

    	$admins = User::whereAdmin(1)->get();
    	$user = new User;

    	$user->email = $request->email;
    	$user->password = bcrypt($request->password);
    	$user->firstname = $request->firstname;
    	$user->lastname = $request->lastname;
    	$user->phone_number = $request->phone_number;
    	$user->branch = $request->branch;
    	$user->admin = $request->admin;
    	$user->active = $request->active;

        $user->save();

        foreach($admins as $admin) {
            Mail::send('email.activate_user', ['user' => $user], function($message) use($user, $admin) {
                $message->to($admin->email, $admin->firstname . ' ' . $admin->lastname)->subject($user->email . ' ได้ลงทะเบียนเข้ามาใหม่');
            });
        }

        alert()->success('คุณต้องรอการยืนยันจากผู้ดูแลระบบจึงจะสามารถเข้าสู่ระบบได้', 'สมัครสมาชิกสำเร็จ !')->persistent('ปิด');

    	return redirect()->back();
    }

    public function postLogin(Request $request) {
    	$this->validate($request, [
    		'email' => 'required|email',
    		'password' => 'required',
    	]);

    	$credentials = [
    		'email' => $request->email,
    		'password' => $request->password,
    	];

    	if(auth()->guard('user')->attempt($credentials, $request->remember_token)) {
    		return redirect('/');
    	}else {
    		alert()->error('อีเมล์ หรือรหัสผ่านไม่ถูกต้อง, กรุณาลองใหม่อีกครั้ง', 'ไม่สามารถเข้าสู่ระบบได้ !')->persistent('ปิด');

    		return redirect()->back();
    	}
    }

    public function getLogout() {
    	auth()->guard('user')->logout();

    	return redirect('login');
    }

    public function getManageUser() {
    	$users = User::all();

    	return view('manage_user', compact('users'));
    }

    public function getCreateUserPage() {
        return view('create_user');
    }

    public function getActivateUser($user_id) {
        $user = User::find($user_id);

        $user->active = !$user->active;

        $user->save();

        alert()->success($user->active ? 'เปิดใช้งานผู้ใช้เรียบร้อยแล้ว' : 'ปิดใช้งานผู้ใช้เรียบร้อยแล้ว', 'สำเร็จ !');
        return redirect('manage_user');
    }

    public function getUser($user_id) {
        $user = User::find($user_id);

        $isAdmin = 1;

        return view('edit_user', compact('user', 'isAdmin'));
    }

    public function updateUser(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'confirmed',
            'firstname' => 'required',
            'lastname' => 'required',
            'phone_number' => 'required|alpha_num|digits:10',
            'branch' => 'required',
            'active' => 'required', 
        ]);

        $user = User::find($request->user_id);

        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone_number = $request->phone_number;
        $user->branch = $request->branch;
        $user->admin = $request->admin;
        $user->active = $request->active;

        $user->save();

        alert()->success('แก้ไขข้อมูลเรียบร้อยแล้ว !')->persistent('ปิด');

        return redirect()->back();
    }

    public function show() {
        return view('show_user');
    }

    public function getUserBySession() {
        $user = User::find(auth()->guard('user')->user()->id);

        $isAdmin = 0;

        return view('edit_user', compact('user', 'isAdmin'));
    }
}
