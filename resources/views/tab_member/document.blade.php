<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}">
    <title>{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname . ' ' . $tab_member->lastname }}</title>
    <style type="text/css">
        body{
            font-family: 'thai';
            font-size: 20px;
        }

        .table {
            width:100%;
            border-collapse: collapse;
            font-size: 20px;
        }

        .table tr th {
            font-weight: bold;
            text-align: left;
            border: 1px solid gray;
            padding: 4px 10px;
        }

        .table tr td {
            /*width:40%;*/
            text-align: left;
            border: 1px solid gray;
            padding: 4px 10px;
        }

        h4 {
            margin: 30px 0 10px 0;
        }

        hr {
            margin: 0 0;
        }

    </style>
</head>
<body>
<h3>ข้อมูลสมาชิก {{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname . ' ' . $tab_member->lastname }}</h3><hr/>
<h4>ข้อมูลส่วนตัว</h4>
<table class="table">
    <tr>
        <th>ประเภทสมาชิก :</th>
        <td>{{ $tab_member->period_type }}</td>
    </tr>
    <tr>
        <th>รหัสสมาชิก :</th>
        <td>{{ $tab_member->no }}</td>
    </tr>
    <tr>
        <th>รหัสสมาชิกเก่า :</th>
        <td>{{ $tab_member->old_no }}</td>
    </tr>
    <tr>
        <th>ชื่อ - นามสกุล</th>
        <td>{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname . ' ' . $tab_member->lastname }}</td>
    </tr>
    <tr>
        <th>หมายเลขบัตรประชาชน :</th>
        <td>{{ $tab_member->idcard }}</td>
    </tr>
    <tr>
        <th>เพศ :</th>
        <td>{{ $tab_member->gender }}</td>
    </tr>
    <tr>
        <th>วันเกิด :</th>
        <td>{{ $tab_member->birthday ? $tab_member->birthday->format('d-m-Y') : '' }}</td>
    </tr>
    <tr>
        <th>สัญชาติ - เชื้อชาติ :</th>
        <td>{{ $tab_member->nationality . ' - ' . $tab_member->race }}</td>
    </tr>
    <tr>
        <th>ศาสนา :</th>
        <td>{{ $tab_member->religion }}</td>
    </tr>
    <tr>
        <td>เบอร์โทรศัพท์มือถือ :</td>
        <td>{{ $tab_member->mobile_number }}</td>
    </tr>
    <tr>
        <td>เบอร์โทรศัพท์ :</td>
        <td>{{ $tab_member->phone_number }} {{ $tab_member->phone_serial_number ? 'ต่อ' : '' }} {{ $tab_member->phone_serial_number }}</td>
    </tr>
</table>
<h4>ที่อยู่ตามบัตรประชาชน</h4>
<table class="table table-striped">
    <tr>
        <th>ภูมิภาค : </th>
        <td>{{ $tab_member->sub_district->district->province->geography->name }}</td>
    </tr>
    <tr>
        <th>ที่อยู่ :</th>
        <td>
            {{ $tab_member->home_number }} หมู่ที่ {{ $tab_member->moo }} {{ $tab_member->village ? 'หมู่บ้าน ' . $tab_member->village : '' }} {{ $tab_member->soi ? 'ซอย' . $tab_member->soi : '' }}  {{ $tab_member->road ? 'ถนน ' . $tab_member->road : '' }}<br/>
            ต.{{ $tab_member->sub_district->name }} อ.{{ $tab_member->sub_district->district->name }}  จ.{{ $tab_member->sub_district->district->province->name }} {{ $tab_member->sub_district->zipcode->zipcode }}

        </td>
    </tr>
</table>
<h4>รายละเอียดอื่นๆ</h4>
<table class="table">
    <tr>
        <th>ที่อยู่ปัจจุบัน :</th>
        <td>{{ $tab_member->present_address }}</td>
    </tr>
    <tr>
        <th>อีเมล :</th>
        <td>{{ $tab_member->email }}</td>
    </tr>
    <tr>
        <th>หมายเลขบัตรคนพิการ :</th>
        <td>{{ $tab_member->no }}</td>
    </tr>
    <tr>
        <th>ระดับการมองเห็น :</th>
        <td>{{ $tab_member->blind_level }}</td>
    </tr>
    <tr>
        <th>สาเหตุความพิการ :</th>
        <td>{{ $tab_member->blind_cause }}</td>
    </tr>
    <tr>
        <th>ระดับการศึกษา :</th>
        <td>{{ $tab_member->education_lavel }}</td>
    </tr>
    <tr>
        <th>จบจากสถานศึกษา :</th>
        <td>{{ $tab_member->education_name }}</td>
    </tr>
    <tr>
        <th>สถานภาพ :</th>
        <td>{{ $tab_member->status }}</td>
    </tr>
    <tr>
        <th>อาชีพ :</th>
        <td>{{ $tab_member->career }}</td>
    </tr>
    <tr>
        <th>หลักสูตรอบรม :</th>
        <td>{{ $tab_member->training }}</td>
    </tr>
    <tr>
        <th>รายได้เฉลี่ยต่อเดือน :</th>
        <td>{{ number_format($tab_member->salary) }} บาท</td>
    </tr>
    <tr>
        <th>สมัครเป็นสมาชิกสามัญประเภท :</th>
        <td>{{ $tab_member->guarantor_type }}</td>
    </tr>
    <tr>
        <th>สมาชิกสามัญผู้รับรองคุณสมบัติ :</th>
        <td>{{ $tab_member->guarantor_name }}</td>
    </tr>
</table>
<h4>ประวัติการชำระค่าบำรุงสมาชิก</h4>
@if(count($tab_member->service_fees) > 0)
    <table class="table">
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

</body>
</html>
