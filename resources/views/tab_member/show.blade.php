@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก &raquo; ' . $tab_member->firstname . ' ' . $tab_member->lastname)

@section('content')

<div class="card">
    <div class="card-body">
        <a href="{{ route('tab_member.edit', $tab_member->no) }}" class="btn btn-warning"><i class="fa fa-edit"> </i> แก้ไขข้อมูล</a>
        <fieldset>
            <h5>ข้อมูลส่วนตัว</h5>
            <table class="table table-striped">
                <tr>
                    <td>ประเภทสมาชิก :</td>
                    <td>{{ $tab_member->period_type }}</td>
                </tr>
                <tr>
                    <td>รหัสสมาชิก :</td>
                    <td>{{ $tab_member->no }}</td>
                </tr>
                <tr>
                    <td>รหัสสมาชิกเก่า :</td>
                    <td>{{ $tab_member->old_no }}</td>
                </tr>
                <tr>
                    <td style="border-top: 0px;width: 20%;">ชื่อ - นามสกุล</td>
                    <td style="border-top: 0px;">{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname . ' ' . $tab_member->lastname }}</td>
                </tr>
                <tr>
                    <td>หมายเลขบัตรประชาชน :</td>
                    <td>{{ $tab_member->idcard }}</td>
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
                    <td>เบอร์โทรศัพท์ :</td>
                    <td>{{ $tab_member->phone_number }}</td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <h5>ที่อยู่ตามบัตรประชาชน</h5>
            <table class="table table-striped">
                <tr>
                    <td style="border-top: 0px;width: 20%;">ภูมิภาค : </td>
                    <td style="border-top: 0;">{{ $tab_member->sub_district->district->province->geography->name }}</td>
                </tr>
                <tr>
                    <td>ที่อยู่ :</td>
                    <td>
                        {{ $tab_member->home_number }} หมู่ที่ {{ $tab_member->moo }} {{ $tab_member->village ? 'หมู่บ้าน ' . $tab_member->village : '' }} {{ $tab_member->soi ? 'ซอย' . $tab_member->soi : '' }}  {{ $tab_member->road ? 'ถนน ' . $tab_member->road : '' }}<br/>
                         ต.{{ $tab_member->sub_district->name }} อ.{{ $tab_member->sub_district->district->name }}  จ.{{ $tab_member->sub_district->district->province->name }} {{ $tab_member->sub_district->zipcode->zipcode }}

                    </td>
                </tr>
            </table>
        </fieldset>
        <fieldset>
            <h5>รายละเอียดอื่นๆ</h5>
            <table class="table table-striped">
                <tr>
                    <td>ที่อยู่ปัจจุบัน :</td>
                    <td>{{ $tab_member->present_address }}</td>
                </tr>
                <tr>
                    <td style="border-top: 0px;width: 20%;">อีเมล :</td>
                    <td style="border-top: 0px;">{{ $tab_member->email }}</td>
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
        <fieldset>
            <h5>ประวัติการชำระค่าบำรุงสมาชิก</h5>
            @if(count($tab_member->service_fees) > 0)
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>ประเภทค่าบำรุงสมาชิก</th>
                    <th>ชำระตั้งแต่วันที่ - ถึงวันที่</th>
                    <th>ผู้ทำรายการ</th>
                    <th>วันที่ทำรายการ</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tab_member->service_fees as $i => $service_fee)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>
                            {{ $service_fee->firstname . ' ' . $service_fee->lastname }} <br/>
                        </td>
                        <td>
                            {{ $service_fee->type }}
                            @if($service_fee->type == 'อื่นๆ')
                                <br/>
                                {{ $service_fee->type_other }}
                            @endif
                        </td>
                        <td>{{ $service_fee->start_date->format('d-m-Y') . ' ถึง ' . $service_fee->end_date->format('d-m-Y') }}</td>
                        <td>
                            {{ $service_fee->staff_firstname . ' ' . $service_fee->staff_lastname  }}
                            <br/>
                            สาขา {{ $service_fee->geography->name }}
                        </td>
                        <td>
                            {{ $service_fee->created_at->format('d-m-Y') }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <hr/>
                <div>
                    <p><i class="fa fa-exclamation"></i> ยังไม่มีประวัติค่าบำรุงสมาชิก</p>
                </div>
            @endif
        </fieldset>
    </div>
</div>

@endsection
