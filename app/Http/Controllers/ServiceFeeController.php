<?php

namespace App\Http\Controllers;

use App\ServiceFee;
use App\TabMember;
use Illuminate\Http\Request;

class ServiceFeeController extends Controller
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
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'staff_firstname' => 'required',
            'staff_lastname' => 'required',
            'geography_id' => 'required',
        ];

        if($request->type == 'อื่นๆ') {
            $rules += [
                'type_other' => 'required'
            ];
        }

        $this->validate($request, $rules);


        $serviceFee = new ServiceFee;

        $serviceFee->tab_member_no = $request->tab_member_no;
        $serviceFee->firstname = $request->firstname;
        $serviceFee->lastname = $request->lastname;
        $serviceFee->type = $request->type;
        $serviceFee->type_other = $request->type ? $request->type_other : null;
        $serviceFee->start_date = date('Y-m-d', strtotime($request->start_date));
        $serviceFee->end_date = date('Y-m-d', strtotime($request->end_date));
        $serviceFee->staff_firstname = $request->staff_firstname;
        $serviceFee->staff_lastname = $request->staff_lastname;
        $serviceFee->user_id = auth()->guard('user')->user()->id;
        $serviceFee->geography_id = $request->geography_id;

        $serviceFee->save();

        alert()->success('บันทึกค่าบำรุงสมาชิกเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect('tab_member/service_fee/' . $request->tab_member_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $tab_member_no
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $serviceFee = ServiceFee::find($id);

        return view('service_fee.edit', compact('serviceFee'));
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
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'type' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'staff_firstname' => 'required',
            'staff_lastname' => 'required',
            'geography_id' => 'required',
        ];

        if($request->type == 'อื่นๆ') {
            $rules += [
                'type_other' => 'required'
            ];
        }

        $this->validate($request, $rules);


        $serviceFee = ServiceFee::find($id);

        $serviceFee->tab_member_no = $request->tab_member_no;
        $serviceFee->firstname = $request->firstname;
        $serviceFee->lastname = $request->lastname;
        $serviceFee->type = $request->type;
        $serviceFee->type_other = $request->type ? $request->type_other : null;
        $serviceFee->start_date = date('Y-m-d', strtotime($request->start_date));
        $serviceFee->end_date = date('Y-m-d', strtotime($request->end_date));
        $serviceFee->staff_firstname = $request->staff_firstname;
        $serviceFee->staff_lastname = $request->staff_lastname;
        $serviceFee->user_id = auth()->guard('user')->user()->id;
        $serviceFee->geography_id = $request->geography_id;

        $serviceFee->save();

        alert()->success('แก้ไขค่าบำรุงสมาชิกเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect('tab_member/service_fee/' . $request->tab_member_no);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceFee = ServiceFee::find($id);

        $serviceFee->delete();

        alert()->success('ลบค่าบำรุงสมาชิกเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect()->back();
    }

    public function getServiceFee($tab_member_no) {
        $tab_member = TabMember::whereNo($tab_member_no)->first();
        $service_fees = ServiceFee::whereTabMemberNo($tab_member_no)->get();

        return view('service_fee.index', compact(['tab_member', 'service_fees']));
    }

    public function createServiceFee($tab_member_no) {
        $tab_member = TabMember::whereNo($tab_member_no)->first();

        return view('service_fee.create', compact('tab_member'));
    }
}
