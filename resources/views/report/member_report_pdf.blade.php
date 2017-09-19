<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="{{ asset('bower_components/font-awesome/css/font-awesome.css') }}">
		<title>รายงานข้อมูลสมาชิก</title>
		<style type="text/css">
		body{
			font-family: 'thai';
			font-size: 19px;
		}

		.table {
			width:100%;
			border-collapse: collapse;
			font-size: 17px;
		}

		.table tr th {
			/*width:60%;*/
			text-align: center;
			border: 1px solid black;
			padding: 6px;
		}

		.table tr td {
			/*width:40%;*/
			text-align: left;
			border: 1px solid black;
			padding: 3px;
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
		<table class="table">
			<tr>
				<th colspan="18"  style="border-right: 0px;">
					แบบทะเบียนสมาชิกสามัญขององค์การคนพิการแต่ละประเภท ระบุชื่อองค์กร...........
				</th>
				<th colspan="4" style="border-left: 0px;">ลายมือชื่อผู้รับรอง.................................................................</th>
			</tr>
			<tr>
				<th rowspan="2">ลำดับที่</th>
				<th rowspan="2">คำนำหน้า</th>
				<th rowspan="2">ชื่อ</th>
				<th rowspan="2">นามสกุล</th>
				<th rowspan="2">วัน/เดือน/ปี เกิด</th>
				<th rowspan="2">อายุ (ปี)</th>
				<th rowspan="2">หมายเลขบัตรประชาชน</th>
				<th colspan="8">ที่อยู่</th>
				<th rowspan="2">เบอร์โทรศัพท์</th>
				<th colspan="4">สถานะผู้สมัคร</th>
				<th rowspan="2">วันเดือนปีที่สมัคร</th>
				<th rowspan="2">ประเภทสมาชิก</th>
			</tr>
			<tr>
				<th>บ้านเลขที่</th>
				<th>หมู่ที่</th>
				<th>อาคาร/หมู่บ้าน</th>
				<th>ตรอก/ซอย</th>
				<th>ถนน</th>
				<th>ตำบล/แขวง</th>
				<th>อำเภอ/เขต</th>
				<th>จังหวัด</th>
				<th>สถานะ</th>
				<th>ประเภทความพิการ</th>
				<th>ชื่อ-สกุล คนพิากร</th>
				<th>หมายเลขคนพิการ</th>
			</tr>
			@foreach($tab_members as $index => $tab_member)
			<tr>
				<td>{{ $index + 1 }}</td>
				<td>{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} </td>
				<td>{{ $tab_member->firstname }}</td>
				<td>{{ $tab_member->lastname }}</td>
				<td>{{ $tab_member->birthday ? $tab_member->birthday->format('d-m-Y') : '' }}</td>
				<td style="width:50px;">{{ $tab_member->age }}</td>
				<td>{{ $tab_member->idcard }}</td>
				<td>{{ $tab_member->home_number }}</td>
				<td>{{ $tab_member->moo }}</td>
				<td>{{ $tab_member->village }}</td>
				<td>{{ $tab_member->soi }}</td>
				<td>{{ $tab_member->road }}</td>
				<td>{{ $tab_member->sub_district ? $tab_member->sub_district->name : '' }}</td>
				<td>{{ $tab_member->sub_district ? $tab_member->sub_district->district->name : '' }}</td>
				<td>{{ $tab_member->sub_district ? $tab_member->sub_district->district->province->name : '' }}</td>
				<td>{{ $tab_member->mobile_number }}</td>
				<td>{{ $tab_member->dead ? 'เสียชีวิต' : 'มีชีวิตอยู่' }}</td>
				<td style="width: 500px;">{{ $tab_member->blind_level }}</td>
				<td>{{ $tab_member->firstname . ' ' . $tab_member->lastname }}</td>
				<td>{{ $tab_member->no }}</td>
				<td>{{ $tab_member->created_at->format('d-m-Y') }}</td>
				<td>{{ $tab_member->period_type }}</td>
			</tr>
			@endforeach
		</table>
	</body>
</html>
