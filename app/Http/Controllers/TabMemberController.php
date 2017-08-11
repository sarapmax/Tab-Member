<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province, App\TabMember, App\Welfare;
use Image;

class TabMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tab_members = null;

        if($request->value) {
            $tab_members = TabMember::where('no', 'like', '%' . $request->value . '%')
                                    ->orWhere('firstname', 'like', '%' . $request->value . '%')
                                    ->orWhere('lastname', 'like', '%' . $request->value . '%')
                                    ->orWhere('phone_number', 'like', '%' . $request->value . '%')
                                    ->orWhere('idcard', 'like', '%' . $request->value . '%')
                                    ->limit(200)
                                    ->get();
        }

        return view('tab_member.index', compact('tab_members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tab_member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name_prefix_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'nationality' => 'required',
            'race' => 'required',
            'religion' => 'required',
            'idcard' => 'required|numeric|digits:13|unique:tab_members',
            'province_id' => 'required',
            'district_id' => 'required',
            'sub_district_id' => 'required',
            'zipcode' => 'required|digits:5',
            'phone_number' => 'required|numeric|digits:10',
            'period_type' => 'required',
            'guarantor_type' => 'required',
            'guarantor_name' => 'required',
        ]);

        $tab_member = new TabMember;
        $tab_member_type = explode('|', $request->guarantor_type);
        $tab_member->no = $this->genMemberNumber($tab_member_type[1], $request->province_id, date('y'), TabMember::count()+1);
        $tab_member->old_no = $request->old_no;
        $tab_member->name_prefix_id = $request->name_prefix_id;
        $tab_member->firstname = $request->firstname;
        $tab_member->lastname = $request->lastname;
        $tab_member->gender = $request->gender;
        $tab_member->birthday = date('Y-m-d', strtotime($request->birthday));
        $tab_member->nationality = $request->nationality;
        $tab_member->race = $request->race;
        $tab_member->religion = $request->religion;
        $tab_member->idcard = $request->idcard;
        $tab_member->home_number = $request->home_number;
        $tab_member->moo = $request->moo;
        $tab_member->village = $request->village;
        $tab_member->soi = $request->soi;
        $tab_member->road = $request->road;
        $tab_member->sub_district_id = $request->sub_district_id;
        $tab_member->email = $request->email;
        $tab_member->phone_number = $request->phone_number;
        $tab_member->type = $request->type;
        $tab_member->period_type = $request->period_type;
        $tab_member->blind_no = $request->blind_no;
        $tab_member->blind_level = $request->blind_level;
        $tab_member->blind_cause = $request->blind_cause;
        $tab_member->blind_name = $request->blind_name;
        $tab_member->education_level = $request->education_level;
        $tab_member->education_name = $request->education_name;
        $tab_member->status = $request->status;
        $tab_member->career = $request->career;
        $tab_member->training = $request->training;
        $tab_member->salary = $request->salary;
        $tab_member->guarantor_type = $tab_member_type[0];
        $tab_member->guarantor_name = $request->guarantor_name;

        $tab_member->save();

        alert()->success('เพิ่มข้อมูลสมาชิกเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

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

        return view('tab_member.show', compact('tab_member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($tab_member_no)
    {
        $tab_member = TabMember::whereNo($tab_member_no)->first();

        return view('tab_member.edit', compact('tab_member'));
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
        $this->validate($request, [
            'name_prefix_id' => 'required',
            'firstname' => 'required',
            'lastname' => 'required',
            'gender' => 'required',
            'birthday' => 'required',
            'nationality' => 'required',
            'race' => 'required',
            'religion' => 'required',
            'idcard' => 'required|numeric|digits:13',
            'province_id' => 'required',
            'district_id' => 'required',
            'sub_district_id' => 'required',
            'zipcode' => 'required|digits:5',
            'phone_number' => 'required|numeric|digits:10',
            'period_type' => 'required',
            'guarantor_type' => 'required',
            'guarantor_name' => 'required',
        ]);

        $tab_member = TabMember::find($id);

        $tab_member->old_no = $request->old_no;
        $tab_member->name_prefix_id = $request->name_prefix_id;
        $tab_member->firstname = $request->firstname;
        $tab_member->lastname = $request->lastname;
        $tab_member->gender = $request->gender;
        $tab_member->birthday = date('Y-d-m', strtotime($request->birthday));
        $tab_member->nationality = $request->nationality;
        $tab_member->race = $request->race;
        $tab_member->religion = $request->religion;
        $tab_member->idcard = $request->idcard;
        $tab_member->home_number = $request->home_number;
        $tab_member->moo = $request->moo;
        $tab_member->village = $request->village;
        $tab_member->soi = $request->soi;
        $tab_member->road = $request->road;
        $tab_member->sub_district_id = $request->sub_district_id;
        $tab_member->email = $request->email;
        $tab_member->phone_number = $request->phone_number;
        $tab_member->type = $request->type;
        $tab_member->period_type = $request->period_type;
        $tab_member->blind_no = $request->blind_no;
        $tab_member->blind_level = $request->blind_level;
        $tab_member->blind_cause = $request->blind_cause;
        $tab_member->blind_name = $request->blind_name;
        $tab_member->education_level = $request->education_level;
        $tab_member->education_name = $request->education_name;
        $tab_member->status = $request->status;
        $tab_member->career = $request->career;
        $tab_member->training = $request->training;
        $tab_member->salary = $request->salary;
        $tab_member->guarantor_type = $request->guarantor_type;
        $tab_member->guarantor_name = $request->guarantor_name;

        $tab_member->save();

        alert()->success('แก้ไขข้อมูลสมาชิกเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tab_member_no)
    {
        $tab_member = TabMember::whereNo($tab_member_no)->first();

        $welfares = Welfare::whereTabMemberNo($tab_member_no)->get();

        foreach($welfares as $welfare) {
            $welfare->delete();
        }

        $tab_member->delete();

        alert()->success('ลบข้อมูลสมาชิกเรียบร้อยแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return redirect()->back();
    }

    public function genMemberNumber($member_type, $province_id, $register_year, $order) {
        $province_code = null;

        if($province_id) {
            $province_code = Province::find($province_id)->code;
        }
        
        $register_year = $register_year+43;
        $order = sprintf("%04d", $order);
        $member_type = $member_type ? $member_type : null;

        return $member_type . '' . $province_code . '' . $register_year . '' . $order;
    }

    public function getTabMemberCard($tab_member_no) {
        $tab_member = TabMember::whereNo($tab_member_no)->first();

        return view('tab_member.card', compact('tab_member'));
    }

    public function uploadProfileImg(Request $request) {
        $tab_member = TabMember::whereNo($request->tab_member_no)->first();

        if($request->hasFile('profile_img')) {
            if($tab_member->profile_img) {
                unlink('uploads/profile_images/'. $tab_member->profile_img);
            }

            $image = $request->file('profile_img');
            $extension      =   $image->getClientOriginalExtension();
            $imageRealPath  =   $image->getRealPath();
            $thumbName      =   'profile_img_'. time() . '_' . $image->getClientOriginalName();

            $img = Image::make($imageRealPath); // use this if you want facade style code
            $img->resize(intval(230), null, function($constraint) {
                 $constraint->aspectRatio();
            });
            $img->save('uploads/profile_images/'. $thumbName);

            $tab_member->profile_img = $thumbName;

            $tab_member->save();

            return redirect()->back();
        }

    }
}
