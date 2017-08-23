<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}">
    <title>สวัสดิการ รหัสสมาชิก {{ $welfare->tab_member_no }} {{ date('d-m-Y') }}</title>
    <style type="text/css">
        body{
            font-family: 'thai';
            font-size: 24px;
        }

        .table {
            width:100%;
            border-collapse: collapse;
            font-size: 22px;
        }

        .table tr th {
            width:30%;
            text-align: left;
            border: 1px solid gray;
            padding: 10px 20px;
        }

        .table tr td {
            /*width:40%;*/
            text-align: left;
            border: 1px solid gray;
            padding: 10px 20px;
        }

        .fa {
            font-family:"fontawesome";
            font-size: 12px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .clearfix {
            clear: both;
        }

    </style>
</head>
<body>
<h3 style="margin-bottom: 0">Tab Member System</h3> <hr/>
<p style="margin: 0"><b>สวัสดิการ {{ $welfare->withdraw_type == 'รับสวัสดิการแทน' ? $welfare->withdraw_firstname . ' ' . $welfare->withdraw_lastname : $welfare->tab_member->firstname . ' ' . $welfare->tab_member->lastname }}</b></p>
<p style="margin: 0 0 20px 0;"><b>เบิกวันที่ {{ $welfare->withdraw_date->format('d-m-Y') }}</b></p>

<table class="table-datatable table table-striped table-hover mv-lg">
    <tbody>
    <tr>
        <th>สถานะ</th>
        <td>
            {{ $welfare->receive_welfare }} <br/>
            @if($welfare->receive_welfare == 'รับสวัสดิการเรียบร้อยแล้ว')
                ณ วันที่ {{ $welfare->receive_welfare_date ? $welfare->receive_welfare_date->format('d-m-Y') : '' }}
            @endif
        </td>
    </tr>
    <tr>
        <th>ประเภทการเบิก</th>
        <td>{{ $welfare->type }}</td>
    </tr>
    <tr>
        <th>หลักฐาน</th>
        <td>{{ $welfare->evidence_name }} - {{ $welfare->evidence }}</td>
    </tr>
    <tr>
        <th>ชื่อผู้ขอเบิก</th>
        <td>{{ $welfare->withdraw_type }} - {{ $welfare->withdraw_type == 'รับสวัสดิการแทน' ? $welfare->withdraw_firstname . ' ' . $welfare->withdraw_lastname : $welfare->tab_member->firstname . ' ' . $welfare->tab_member->lastname }}</td>
    </tr>
    <tr>
        <th>เบอร์โทรศัพท์</th>
        <td>{{ $welfare->withdraw_phone_number }}</td>
    </tr>
    <tr>
        <th>จำนวนเงิน</th>
        <td>{{ number_format($welfare->amount) }} บาท</td>
    </tr>
    <tr>
        <th>รายละเอียดเพิ่มเติม</th>
        <td>{{ $welfare->comment }}</td>
    </tr>
    <tr>
        <th>ผู้ทำรายการ</th>
        <td>
            {{ $welfare->staff_firstname . ' ' . $welfare->staff_lastname }} <br/>
            สาขา {{ $welfare->geography->name }}
        </td>
</tr>
</tbody>
</table>

</body>
</html>
