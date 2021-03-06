<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>รายงานข้อมูลสมาชิก</title>

		<style type="text/css">

		@font-face {
			font-family: 'THSarabunNew';
			src: url('{{ resource_path('fonts/THSarabunNew.ttf') }}');
		}

		@font-face {
			font-family: 'THSarabunNew';
			src: url('{{ resource_path('fonts/THSarabunNew Bold.ttf') }}');
			font-weight: bold;
		}

		body {
			font-family: 'THSarabunNew';
			font-size: 19px;
		}

		.table {
			width:100%;
			border-collapse: collapse;
			font-size: 17px;
		}

		.table tr th {
			text-align: center;
			border: 1px solid black;
			padding: 6px;
		}

		.table tr td {
			text-align: left;
			border: 1px solid black;
			padding: 3px;
		}

		.page-break {
			page-break-inside: avoid;
		}

	</style>
	</head>
	<body>
	<div class="page">
		<h2 style="margin-bottom: 0px;text-align: center;">แบบรายงานข้อมูลทะเบียนสมาชิก สมาคมคนตาบอดแห่งประเทศไทย</h2> <hr/>
		<ul style="margin-top: 0px;list-style: none;padding:0px;">
			<li><strong>ภูมิภาค:</strong> {{ $input['geography'] ? $input['geography']['name'] : 'ทั้งหมด' }}</li>
			<li><strong>จังหวัด:</strong> {{ $input['province'] ? $input['province']['name'] : 'ทั้งหมด' }}</li>
			<li><strong>ประเภทสมาชิก:</strong> {{ $input['period_type'] ? $input['period_type'] : 'ทั้งหมด' }}</li>
			<li><strong>ระดับการมองเห็น:</strong> {{ $input['blind_level'] ? $input['blind_level']  : 'ทั้งหมด' }}</li>
			<li><strong>ระดับการศึกษา:</strong> {{ $input['education_level'] ? $input['education_level']  : 'ทั้งหมด' }}</li>
			<li><strong>เพศ:</strong> {{ $input['gender'] ? $input['gender']  : 'ทั้งหมด' }}</li>
			<li><strong>ช่วงอายุ:</strong> {{ $input['start_age'] ? $input['start_age'] . ' - ' .$input['end_age'] . ' ปี' : 'ทั้งหมด' }}</li>
		</ul>

		<table class="table">
			<tr class="page-break">
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
			<tr class="page-break">
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
				<th>ชื่อ-สกุล คนพิการ</th>
				<th>หมายเลขคนพิการ</th>
			</tr>
			@foreach($tab_members as $index => $tab_member)
			<tr class="page-break">
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
				<td>{{ !empty($tab_member->sub_district->name) ? $tab_member->sub_district->name : '' }}</td>
				<td>{{ !empty($tab_member->sub_district->district->name) ? $tab_member->sub_district->district->name : '' }}</td>
				<td>{{ !empty($tab_member->sub_district->district->province->name) ? $tab_member->sub_district->district->province->name : '' }}</td>
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
	</div>
	</body>
</html>
