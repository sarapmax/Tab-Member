<html>
	<meta charset="utf-8">

	<table class="table">
		<tr>
			<th colspan="22">
				<h2>แบบรายงานข้อมูลทะเบียนสมาชิก สมาคมคนตาบอดแห่งประเทศไทย</h2>
			</th>
		</tr>
		<tr>
			<td colspan="22"><strong>ภูมิภาค:</strong> {{ $input['geography'] ? $input['geography']['name'] : 'ทั้งหมด' }}</td>
		</tr>
		<tr>
			<td colspan="22"><strong>จังหวัด:</strong> {{ $input['province'] ? $input['province']['name'] : 'ทั้งหมด' }}</td>
		</tr>
		<tr>
			<td colspan="22"><strong>ประเภทสมาชิก:</strong> {{ $input['period_type'] ? $input['period_type'] : 'ทั้งหมด' }}</td>
		</tr>
		<tr>
			<td colspan="22"><strong>ระดับการมองเห็น:</strong> {{ $input['blind_level'] ? $input['blind_level']  : 'ทั้งหมด' }}</td>
		</tr>
		<tr>
			<td colspan="22"><strong>ระดับการศึกษา:</strong> {{ $input['education_level'] ? $input['education_level']  : 'ทั้งหมด' }}</td>
		</tr>
		<tr>
			<td colspan="22"><strong>เพศ:</strong> {{ $input['gender'] ? $input['gender']  : 'ทั้งหมด' }}</td>
		</tr>
		<tr>
			<td colspan="22"><strong>ช่วงอายุ:</strong> {{ $input['start_age'] ? $input['start_age'] . ' - ' .$input['end_age'] . ' ปี' : 'ทั้งหมด' }}</td>
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
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th></th>
			<th>บ้านเลขที่</th>
			<th>หมู่ที่</th>
			<th>อาคาร/หมู่บ้าน</th>
			<th>ตรอก/ซอย</th>
			<th>ถนน</th>
			<th>ตำบล/แขวง</th>
			<th>อำเภอ/เขต</th>
			<th>จังหวัด</th>
			<th></th>
			<th>สถานะ</th>
			<th>ประเภทความพิการ</th>
			<th>ชื่อ-สกุล คนพิการ</th>
			<th>หมายเลขคนพิการ</th>
		</tr>
		@foreach($tab_members as $index => $tab_member)
			<tr>
				<td>{{ $index + 1 }}</td>
				<td>{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} </td>
				<td>{{ $tab_member->firstname }}</td>
				<td>{{ $tab_member->lastname }}</td>
				<td>{{ $tab_member->birthday ? $tab_member->birthday->format('d-m-Y') : '' }}</td>
				<td>{{ $tab_member->age }}</td>
				<td>{{ (string) $tab_member->idcard }}</td>
				<td>{{ (string) $tab_member->home_number }}</td>
				<td>{{ $tab_member->moo }}</td>
				<td>{{ $tab_member->village }}</td>
				<td>{{ $tab_member->soi }}</td>
				<td>{{ $tab_member->road }}</td>
				<td>{{ !empty($tab_member->sub_district->name) ? $tab_member->sub_district->name : '' }}</td>
				<td>{{ !empty($tab_member->sub_district->district->name) ? $tab_member->sub_district->district->name : '' }}</td>
				<td>{{ !empty($tab_member->sub_district->district->province->name) ? $tab_member->sub_district->district->province->name : '' }}</td>
				<td>{{ $tab_member->mobile_number }}</td>
				<td>{{ $tab_member->dead ? 'เสียชีวิต' : 'มีชีวิตอยู่' }}</td>
				<td>{{ $tab_member->blind_level }}</td>
				<td>{{ $tab_member->firstname . ' ' . $tab_member->lastname }}</td>
				<td>{{ $tab_member->no }}</td>
				<td>{{ $tab_member->created_at->format('d-m-Y') }}</td>
				<td>{{ $tab_member->period_type }}</td>
			</tr>
		@endforeach
	</table>
</html>
