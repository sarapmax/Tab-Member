<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Province, App\TabMember, App\Welfare;
use Image;
use PDF;

class TabMemberController extends Controller
{
    /**
     * @var TabMember
     */
    protected $tabMember;

    /**
     * TabMemberController constructor.
     *
     * @param TabMember $tabMember
     */
    public function __construct(TabMember $tabMember) {
        $this->tabMember = $tabMember;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters['no'] = $request->input('no');
        $filters['name'] = $request->input('name');
        $filters['phone_number'] = $request->input('phone_number');
        $filters['idcard'] = $request->input('idcard');

        $tab_members = $this->tabMember->with('name_prefix');

        if(!empty($filters)) {
            if(!empty($filters['no'])) {
                $tab_members->where('no', 'like', '%' . $filters['no'] . '%');
            }

            if(!empty($filters['name'])) {
                $tab_members->where(function($q) use ($filters) {
                    $q->where('firstname', 'LIKE', '%' . $filters['name'] . '%')
                        ->orWhere('lastname', 'LIKE', '%' . $filters['name'] . '%');
                });
            }

            if(!empty($filters['phone_number'])) {
                $tab_members->where(function($q) use ($filters) {
                    $q->where('phone_number', 'LIKE', '%' . $filters['phone_number'] . '%')
                        ->orWhere('mobile_number', 'LIKE', '%' . $filters['phone_number'] . '%');
                });
            }

            if(!empty($filters['idcard'])) {
                $tab_members->where('idcard', 'like', '%' . $filters['idcard'] . '%');
            }
        }

        return view('tab_member.index', ['tab_members' => $tab_members->paginate(20), 'filters' => $filters]);
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
            'idcard' => 'required|numeric|digits:13|unique:tab_members',
            'province_id' => 'required',
            'district_id' => 'required',
            'sub_district_id' => 'required',
            'zipcode' => 'required|digits:5',
            'present_address' => 'required',
            'mobile_number' => 'required|numeric|digits:10',
            'phone_number' => 'required|numeric|digits_between:9,10',
            'period_type' => 'required',
            'guarantor_type' => 'required',
            'guarantor_name' => 'required',
        ]);

        $tab_member = new TabMember;
        $tab_member->no = $this->genMemberNumber($request->guarantor_type, $request->province_id, date('y'), TabMember::count()+1);
        $tab_member->old_no = $request->old_no;
        $tab_member->name_prefix_id = $request->name_prefix_id;
        $tab_member->firstname = $request->firstname;
        $tab_member->lastname = $request->lastname;
        $tab_member->gender = $request->gender;
        $tab_member->birthday = new \DateTime($request->birthday);
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
        $tab_member->mobile_number = $request->mobile_number;
        $tab_member->phone_number = $request->phone_number;
        $tab_member->phone_serial_number = $request->phone_serial_number;
        $tab_member->period_type = $request->period_type;
        $tab_member->blind_no = $request->blind_no;
        $tab_member->blind_level = $request->blind_level;
        $tab_member->blind_cause = $request->blind_cause;
        $tab_member->present_address = $request->present_address;
        $tab_member->education_level = $request->education_level;
        $tab_member->education_name = $request->education_name;
        $tab_member->status = $request->status;
        $tab_member->career = $request->career;
        $tab_member->training = $request->training;
        $tab_member->salary = $request->salary;
        $tab_member->guarantor_type = $request->guarantor_type;
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
            'idcard' => 'required|numeric|digits:13',
            'province_id' => 'required',
            'district_id' => 'required',
            'sub_district_id' => 'required',
            'zipcode' => 'required|digits:5',
            'present_address' => 'required',
            'mobile_number' => 'required|numeric|digits:10',
            'phone_number' => 'required|numeric|digits_between:9,10',
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
        $tab_member->birthday = new \DateTime($request->birthday);
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
        $tab_member->mobile_number = $request->mobile_number;
        $tab_member->phone_number = $request->phone_number;
        $tab_member->phone_serial_number = $request->phone_serial_number;
        $tab_member->period_type = $request->period_type;
        $tab_member->blind_no = $request->blind_no;
        $tab_member->blind_level = $request->blind_level;
        $tab_member->blind_cause = $request->blind_cause;
        $tab_member->present_address = $request->present_address;
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

        return redirect('tab_member/' . $tab_member->no);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $tab_member_no
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

    public function genMemberNumber($guarantor_type, $province_id, $register_year, $order) {
        $province_code = null;

        if($province_id) {
            $province_code = Province::find($province_id)->code;
        }
        
        $register_year = $register_year+43;
        $order = sprintf("%04d", $order);

        return $this->convertGuarantorTypeToNumber($guarantor_type) . '' . $province_code . '' . $register_year . '' . $order;
    }

    public function convertGuarantorTypeToNumber($guarantor_type) {
        $result = null;

        switch ($guarantor_type) {
            case 'บุคคลสามัญ' :
                $result = '1';
                break;
            case 'บุคคลวิสามัญ' :
                $result = '2';
                break;
            case 'บุคคลกิติมศักดิ์' :
                $result = '3';
                break;
            case 'นิติบุคคลสามัญ' :
                $result = '4';
                break;
            case 'นิติบุคคลวิสามัญ' :
                $result = '5';
                break;
            case 'นิติบุคคลกิติมศักดิ์' :
                $result = '6';
                break;
            case 'คณะบุคคลสามัญ' :
                $result = '7';
                break;
            case 'คณะบุคคลวิสามัญ' :
                $result = '8';
                break;
            case 'คณะบุคคลกิติมศักดิ์' :
                $result = '9';
                break;
            default :
                $result = '0';
        }

        return $result;
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

    public function generateTabMemberPdf($tab_member_no, $type) {
        $tab_member = TabMember::whereNo($tab_member_no)->first();

        $pdf = PDF::loadView('tab_member.document', ['tab_member' => $tab_member]);

        $tabMemberName = $tab_member->firstname . ' ' . $tab_member->lastname;

        if($type == 'download') {
            return $pdf->download('ข้อมูลสมาชิก ' . $tabMemberName .'.pdf');
        }else {
            return $pdf->stream('ข้อมูลสมาชิก ' . $tabMemberName .'.pdf');
        }

    }
}
