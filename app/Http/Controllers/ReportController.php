<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TabMember, App\Geography, App\Province, App\SubDistrict, App\NamePrefix;
use DB;
use Excel, PDF;
use DateTime;
use App\Http\Controllers\TabMemberController;
use Carbon\Carbon;

class ReportController extends Controller
{
    protected $tabMemberController;

    public function __construct(TabMemberController $tabMemberController) {
        $this->tabMemberController = $tabMemberController;
    }

    public function getReport() {
    	return view('report.index');
    }

    public function getMemberReport(Request $request) {

    	$this->validate($request, [
    		'report_type' => 'required',
    	]);

    	$input['geography'] = Geography::find($request->geography_id);
    	$input['province'] = Province::find($request->province_id);
    	$input['period_type'] = $request->period_type;
    	$input['blind_level'] = $request->blind_level;
    	$input['education_level'] = $request->education_level;
    	$input['gender'] = $request->gender;
    	$input['start_age'] = $request->start_age;
    	$input['end_age'] = $request->end_age;

        $tab_members = TabMember::select('tab_members.*', 'geographies.name AS geography_name', 'provinces.name AS province_name')
            ->join('sub_districts', 'tab_members.sub_district_id', 'sub_districts.id')
            ->join('provinces', 'sub_districts.province_id', 'provinces.id')
            ->join('geographies', 'provinces.geography_id', 'geographies.id')
            ->where(function($q) use ($request) {
                if($request->geography_id) {
                    $q->where('geographies.id', $request->geography_id);
                }

                if($request->province_id) {
                    $q->where('provinces.id', $request->province_id);
                }

                if($request->period_type) {
                    $q->where('tab_members.period_type', $request->period_type);
                }

                if($request->blind_level) {
                    $q->where('tab_members.blind_level', $request->blind_level);
                }

                if($request->education_level) {
                    $q->where('tab_members.education_level', $request->education_level);
                }

                if($request->gender) {
                    $q->where('tab_members.gender', $request->gender);
                }

                if($request->start_age && $request->end_age) {
                    $q->whereBetween('tab_members.age', [$request->start_age, $request->end_age]);
                    $q->orderBy('tab_members.age', 'asc');
                }
            })
            ->get();

    	if($request->report_type == 'xls') {
    		Excel::create('รายงานข้อมูลสมาชิก-'.date('d-m-Y'), function($excel) use($tab_members, $input) {
			    $excel->sheet('รายงานข้อมูลสมาชิก', function($sheet) use($tab_members, $input) {
                    $sheet->setColumnFormat([
                        'G' => '0',
                        'H' => '0'
                    ]);
			        $sheet->loadView('report.member_report_xls', ['tab_members' => $tab_members, 'input' => $input]);
			    })->export('xls');
			});
    	}else {
    		$pdf = PDF::loadView('report.member_report_pdf', ['tab_members' => $tab_members, 'input' => $input], [], [
                'format' => 'A2-L',
            ]);

            return $pdf->stream('รายงานข้อมูลสมาชิก-'.date('d-m-Y').'.pdf');
    	}

    	return view('report.member_report_pdf', compact('tab_members'));
    }

    public function getImport() {
        return view('report.import');
    }

    public function importReport(Request $request) {
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();

            $data = Excel::load($path, function($reader) {
            })->get();

            if(!empty($data) && $data->count()){
                foreach ($data as $index => $value) {
                    if($index > 1) {
                        $subDistrict = SubDistrict::whereName($value->district)->first();
                        $namePrefix = NamePrefix::whereName($value->prefix)->first();
                        $province = Province::whereName($value->province)->first();
                        $tab_member_count = TabMember::count();
                        TabMember::create([
                                    'old_no' => (string) $value->member_no_old,
                                    'no' => $this->tabMemberController->genMemberNumber(
                                        $value->guarantor_type,
                                        !empty($province->id) ? $province->id : null,
                                        date('y'),
                                        $tab_member_count + ($index + 1)
                                    ),
                                    'name_prefix_id' => !empty($namePrefix->id) ? $namePrefix->id : null,
                                    'firstname' => $value->firstname,
                                    'lastname' => $value->surname,
                                    'gender' => $value->gender,
                                    'nationality' => $value->nationality,
                                    'race' => $value->race,
                                    'religion' => $value->religion,
                                    'idcard' => (string) $value->id_card,
                                    'home_number' => $value->home_no,
                                    'moo' => (string) $value->moo,
                                    'village' => $value->village,
                                    'soi' => $value->soi,
                                    'road' => $value->road,
                                    'sub_district_id' => !empty($subDistrict->id) ? $subDistrict->id : null,
                                    'email' => $value->email,
                                    'mobile_number' => $value->mobile,
                                    'phone_number' => $value->phone_number,
                                    'phone_serial_number' => $value->phone_serial_number,
                                    'period_type' => $value->type_member,
                                    'present_address' => $value->present_address,
                                    'blind_no' => $value->blind_no,
                                    'blind_level' => $value->blind_level,
                                    'blind_cause' => $value->blind_cause,
                                    'education_level' => $value->education_level,
                                    'education_name' => $value->education_name,
                                    'birthday' => $this->validateDate($value->birthday) ? $value->birthday : null,
                                    'status' => $value->status,
                                    'career' => $value->career,
                                    'training' => $value->training,
                                    'salary' => $value->salary,
                                    'guarantor_type' => $value->guarantor_type,
                                    'guarantor_name' => $value->guarantor_name,
                                    'remark' => $value->remark,
                                    'dead' => $value->dead,
                                    'dead_date' => $this->validateDate($value->dead_date) ? $value->dead_date : null,
                                    'dead_no' => (string) $value->dead_no,
                                    'age' => $this->validateDate($value->birthday) ? 542 - calAge($value->birthday) : null,
                                ]);
                    }
                }
            }
        }

        alert()->success('Import ข้อมูลสำเร็จแล้ว', 'สำเร็จ !')->persistent('ปิด');

        return back();
    }

    function validateDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        
        return $d && $d->format('Y-m-d') === $date;
    }
}
