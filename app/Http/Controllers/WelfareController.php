<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TabMember, App\Welfare;

class WelfareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request , [
            'tab_member_no' => 'required|numeric',
            'withdraw_firstname' => 'required',
            'withdraw_lastname' => 'required',
            'withdraw_phone_number' => 'required|numeric|digits:10',
            'type' => 'required',
            'amount' => 'required|numeric',
        ]);

        $welfare = new Welfare;

        $welfare->tab_member_no = $request->tab_member_no;
        $welfare->user_id = auth()->guard('user')->user()->id;
        $welfare->withdraw_firstname = $request->withdraw_firstname;
        $welfare->withdraw_lastname = $request->withdraw_lastname;
        $welfare->withdraw_phone_number = $request->withdraw_phone_number;
        $welfare->type = $request->type;
        $welfare->amount = $request->amount;
        $welfare->comment = $request->comment;

        $welfare->save();

        alert()->success('บันทึกข้อมูลเบิกสวัสดิการเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($tab_member_no)
    {
        $tab_member = TabMember::whereNo($tab_member_no)->first();
        $welfares = Welfare::whereTabMemberNo($tab_member_no)->orderBy('created_at', 'DESC')->get();

        return view('welfare.index', compact(['tab_member', 'welfares']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Welfare::find($id)->delete();

        alert()->success('ลบข้อมูลเบิกสวัสดิการเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect()->back();
    }
}
