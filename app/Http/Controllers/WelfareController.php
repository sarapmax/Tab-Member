<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TabMember, App\Welfare;
use PDF;

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
            'withdraw_type' => 'required',
            'tab_member_no' => 'required|numeric',
            'withdraw_phone_number' => 'required|numeric|digits:10',
            'type' => 'required',
            'amount' => 'required|numeric',
            'evidence_name' => 'required',
            'withdraw_date' => 'required',
            'staff_firstname' => 'required',
            'staff_lastname' => 'required',
            'geography_id' => 'required',
            'receive_welfare' => 'required',
        ];

        if($request->withdraw_type == 'รับสวัสดิการแทน') {
            $rules += [
                'withdraw_firstname' => 'required',
                'withdraw_lastname' => 'required'
            ];
        }

        if($request->receive_welfare == 'รับสวัสดิการเรียบร้อยแล้ว') {
            $rules += [
                'receive_welfare_date' => 'required',
            ];
        }

        $this->validate($request , $rules);

        $welfare = new Welfare;

        if($request->hasFile('evidence')) {
            $evidence = $request->file('evidence');

            $evidenceName = time() . '-' . $evidence->getClientOriginalName();

            $evidence->move('welfare_evidences/', $evidenceName);

            $welfare->evidence = $evidenceName;
        }

        $welfare->withdraw_type = $request->withdraw_type;
        $welfare->evidence_name = $request->evidence_name;
        $welfare->withdraw_date = new \DateTime($request->withdraw_date);
        $welfare->tab_member_no = $request->tab_member_no;
        $welfare->user_id = auth()->guard('user')->user()->id;
        $welfare->withdraw_firstname = $request->withdraw_firstname;
        $welfare->withdraw_lastname = $request->withdraw_lastname;
        $welfare->withdraw_phone_number = $request->withdraw_phone_number;
        $welfare->type = $request->type;
        $welfare->amount = $request->amount;
        $welfare->comment = $request->comment;
        $welfare->staff_firstname = $request->staff_firstname;
        $welfare->staff_lastname = $request->staff_lastname;
        $welfare->geography_id = $request->geography_id;
        $welfare->receive_welfare_date = $request->receive_welfare_date ? new \DateTime($request->receive_welfare_date) : null;
        $welfare->receive_welfare = $request->receive_welfare;

        $welfare->save();

        alert()->success('บันทึกข้อมูลเบิกสวัสดิการเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect('tab_member/welfare/' . $request->tab_member_no);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $tab_member_no
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
        $welfare = Welfare::find($id);

        return view('welfare.edit' , compact('welfare'));
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
            'withdraw_type' => 'required',
            'tab_member_no' => 'required|numeric',
            'withdraw_phone_number' => 'required|numeric|digits:10',
            'type' => 'required',
            'amount' => 'required|numeric',
            'evidence_name' => 'required',
            'withdraw_date' => 'required',
            'staff_firstname' => 'required',
            'staff_lastname' => 'required',
            'geography_id' => 'required',
            'receive_welfare' => 'required',
        ];

        if($request->withdraw_type == 'รับสวัสดิการแทน') {
            $rules += [
                'withdraw_firstname' => 'required',
                'withdraw_lastname' => 'required'
            ];
        }

        if($request->receive_welfare == 'รับสวัสดิการเรียบร้อยแล้ว') {
            $rules += [
                'receive_welfare_date' => 'required',
            ];
        }

        $this->validate($request , $rules);

        $welfare = Welfare::find($id);

        if($request->hasFile('evidence')) {
            unlink('welfare_evidences/' . $welfare->evidence);

            $evidence = $request->file('evidence');

            $evidenceName = time() . '-' . $evidence->getClientOriginalName();

            $evidence->move('welfare_evidences/', $evidenceName);

            $welfare->evidence = $evidenceName;
        }

        $welfare->withdraw_type = $request->withdraw_type;
        $welfare->evidence_name = $request->evidence_name;
        $welfare->withdraw_date = new \DateTime($request->withdraw_date);
        $welfare->tab_member_no = $request->tab_member_no;
        $welfare->user_id = auth()->guard('user')->user()->id;
        $welfare->withdraw_firstname = $request->withdraw_firstname;
        $welfare->withdraw_lastname = $request->withdraw_lastname;
        $welfare->withdraw_phone_number = $request->withdraw_phone_number;
        $welfare->type = $request->type;
        $welfare->amount = $request->amount;
        $welfare->comment = $request->comment;
        $welfare->staff_firstname = $request->staff_firstname;
        $welfare->staff_lastname = $request->staff_lastname;
        $welfare->geography_id = $request->geography_id;
        $welfare->receive_welfare_date = $request->receive_welfare_date ? new \Datetime($request->receive_welfare_date) : null;
        $welfare->receive_welfare = $request->receive_welfare;

        $welfare->save();

        alert()->success('แก้ไขข้อมูลเบิกสวัสดิการเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect('tab_member/welfare/' . $request->tab_member_no);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $welfare = Welfare::find($id);

        if($welfare->evidence) {
            unlink('welfare_evidences/' . $welfare->evidence);
        }

        $welfare->delete();

        alert()->success('ลบข้อมูลเบิกสวัสดิการเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect()->back();
    }

    /**
     * @param $tab_member_no
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createWelfare($tab_member_no)
    {
        $tab_member = TabMember::whereNo($tab_member_no)->first();

        return view('welfare.create', compact('tab_member'));
    }

    public function printWelfare($id)
    {
        $welfare = Welfare::find($id);

        $pdf = PDF::loadView('welfare.report', ['welfare' => $welfare]);

        return $pdf->stream('สวัสดิการ รหัสสมาชิก ' . $welfare->tab_member_no . ' ' .date('d-m-Y').'.pdf');
    }
}
