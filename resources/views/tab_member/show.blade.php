@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก &raquo; ' . $tab_member->name_prefix->name . ' ' . $tab_member->firstname . ' ' . $tab_member->lastname)

@section('content')

<div class="card">
    <div class="card-body">

        {{-- <ul id="myTabs" role="tablist" class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a id="member-detail-tab" href="#member_detail" role="tab" data-toggle="tab" aria-controls="member_detail" aria-expanded="true">ข้อมูลสมาชิก</a></li>
            <li role="presentation"><a id="welfare-detail-tab" href="#welfare_detail" role="tab" data-toggle="tab" aria-controls="welfare_detail">ข้อมูลการเบิกสวัสดิการ</a></li>
        </ul> --}}
            {{-- <div id="myTabContent" class="tab-content"> --}}
                {{-- <div id="member_detail" role="tabpanel" aria-labelledby="member-detail-tab" class="tab-pane fade in active"> --}}
                    <fieldset>
                        <h5>ข้อมูลส่วนตัว</h5>
                        <table class="table table-striped">
                            <tr>
                                <td style="border-top: 0px;width: 20%;">ชื่อ - นามสกุล</td>
                                <td style="border-top: 0px;">{{ $tab_member->name_prefix->name . ' ' . $tab_member->firstname . ' ' . $tab_member->lastname }}</td>
                            </tr>
                            <tr>
                                <td>หมายเลขสมาชิกเก่า :</td>
                                <td>{{ $tab_member->old_no }}</td>
                            </tr>
                            <tr>
                                <td>เพศ :</td>
                                <td>{{ $tab_member->gender }}</td>
                            </tr>
                            <tr>
                                <td>วันเกิด :</td>
                                <td>{{ $tab_member->birthday ? $tab_member->birthday->format('d-m-Y') : '' }}</td>
                            </tr>
                            <tr>
                                <td>สัญชาติ - เชื้อชาติ :</td>
                                <td>{{ $tab_member->nationality . ' - ' . $tab_member->race }}</td>
                            </tr>
                            <tr>
                                <td>ศาสนา :</td>
                                <td>{{ $tab_member->religion }}</td>
                            </tr>
                            <tr>
                                <td>หมายเลขบัตรประชาชน :</td>
                                <td>{{ $tab_member->idcard }}</td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <h5>ที่อยู่ตามบัตรประชาชน</h5>   
                        <table class="table table-striped">
                            <tr>
                                <td style="border-top: 0px;width: 20%;">ภูมิภาค ({{ $tab_member->sub_district->district->province->geography->name }}) : </td>
                                <td style="border-top: 0;">ตำบล <b>{{ $tab_member->sub_district->name }}</b> อำเภอ <b>{{ $tab_member->sub_district->district->name }}</b> จังหวัด <b>{{ $tab_member->sub_district->district->province->name }}</b>    <b>{{ $tab_member->sub_district->zipcode->zipcode }}</b> </td>
                            </tr>
                            <tr>
                                <td>ที่อยู่ :</td>
                                <td>{{ $tab_member->home_number }} หมู่ที่ {{ $tab_member->moo }} {{ $tab_member->village ? 'หมู่บ้าน ' . $tab_member->village : '' }} {{ $tab_member->soi ? 'ซอย' . $tab_member->soi : '' }}  {{ $tab_member->road ? 'ถนน ' . $tab_member->road : '' }}</td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset>
                        <h5>ข้อมูลอื่นๆ</h5>   
                        <table class="table table-striped">
                            <tr>
                                <td style="border-top: 0px;width: 20%;">อีเมล์ :</td>
                                <td style="border-top: 0px;">{{ $tab_member->email }}</td>
                            </tr>
                            <tr>
                                <td>เบอร์โทรศัพท์ :</td>
                                <td>{{ $tab_member->phone_number }}</td>
                            </tr>
                             <tr>
                                <td>สถานะ :</td>
                                <td>{{ $tab_member->type }}</td>
                            </tr>
                            <tr>
                                <td>ประเภท :</td>
                                <td>{{ $tab_member->period_type }}</td>
                            </tr>
                             <tr>
                                <td>ชื่อคนพิการ :</td>
                                <td>{{ $tab_member->blind_name }}</td>
                            </tr>
                            <tr>
                                <td>หมายเลขบัตรคนพิการ :</td>
                                <td>{{ $tab_member->blind_no }}</td>
                            </tr>
                             <tr>
                                <td>ระดับการมองเห็น :</td>
                                <td>{{ $tab_member->blind_level }}</td>
                            </tr>
                            <tr>
                                <td>สาเหตุความพิการ :</td>
                                <td>{{ $tab_member->blind_cause }}</td>
                            </tr>
                             <tr>
                                <td>ระดับการศึกษา :</td>
                                <td>{{ $tab_member->education_lavel }}</td>
                            </tr>
                            <tr>
                                <td>จบจากสถานศึกษา :</td>
                                <td>{{ $tab_member->education_name }}</td>
                            </tr>
                             <tr>
                                <td>สถานภาพ :</td>
                                <td>{{ $tab_member->status }}</td>
                            </tr>
                            <tr>
                                <td>อาชีพ :</td>
                                <td>{{ $tab_member->career }}</td>
                            </tr>
                             <tr>
                                <td>หลักสูตรอบรม :</td>
                                <td>{{ $tab_member->training }}</td>
                            </tr>
                            <tr>
                                <td>รายได้เฉลี่ยต่อเดือน :</td>
                                <td>{{ number_format($tab_member->salary) }} บาท</td>
                            </tr>
                            <tr>
                                <td>สมัครเป็นสมาชิกสามัญประเภท :</td>
                                <td>{{ $tab_member->guarantor_type }}</td>
                            </tr>
                            <tr>
                                <td>สมาชิกสามัญผู้รับรองคุณสมบัติ :</td>
                                <td>{{ $tab_member->guarantor_name }}</td>
                            </tr>
                        </table>
                    </fieldset>
                {{-- </div> --}}
            
                {{-- <div id="welfare_detail" role="tabpanel" aria-labelledby="welfare-detail-tab" class="tab-pane fade"> --}}
                    {{-- <h4>Profile view</h4> --}}
                {{-- </div> --}}
            {{-- </div> --}}

    </div>
</div>

@endsection