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
			text-align: left;
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
		<h2 style="margin-bottom: 0px;">รายงานข้อมูลสมาชิก</h2> <hr/>
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
			<thead>
				<tr>
					<th>ลำดับ</th>
					<th>รหัสสมาชิก</th>
					<th>ชื่อ - สกุล</th>
					<th>อายุ(ปี)</th>
					<th>เพศ</th>
					<th>ประเภทสมาชิก</th>
				</tr>
			</thead>
			<tbody>
				@foreach($tab_members as $index => $tab_member)
				<tr>
					<td>{{ $index + 1 }}</td>
					<td>{{ $tab_member->no }}</td>
					<td>{{ $tab_member->name_prefix_id ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname }} {{ $tab_member->lastname }}</td>
					<th>{{ $tab_member->age }}</th>
					<td>{{ $tab_member->gender }}</td>
					<td>{{ $tab_member->period_type }}</td>
				</tr>
				@endforeach
			</tbody>
		</table>

	</body>
</html>
