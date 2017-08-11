<html>
	<meta charset="utf-8">
	
	<table>
		<thead>
			<tr>
				<td colspan="7"><strong>ภูมิภาค:</strong> {{ $input['geography'] ? $input['geography']['name'] : 'ทั้งหมด' }}</td>
			</tr>
			<tr>
				<td colspan="7"><strong>จังหวัด:</strong> {{ $input['province'] ? $input['province']['name'] : 'ทั้งหมด' }}</td>
			</tr>
			<tr>
				<td colspan="7"><strong>ระดับการมองเห็น:</strong> {{ $input['blind_level'] ? $input['blind_level']  : 'ทั้งหมด' }}</td>
			</tr>
			<tr>
				<td colspan="7"><strong>ช่วงอายุ:</strong> {{ $input['start_age'] ? $input['start_age'] . ' - ' .$input['end_age'] . ' ปี' : 'ทั้งหมด' }}</td>
			</tr>
			<tr>
				<td></td>
			</tr>
			<tr>
				<th>ลำดับ</th>
				<th>รหัสสมาชิก</th>
				<th>ชื่อ - สกุล</th>
				<th>อายุ(ปี)</th>
				<th>เพศ</th>
				<th>ภูมิภาค</th>
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
				<td>{{ $tab_member->geography_name }}</td>
				<td>{{ $tab_member->period_type }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

</html>
