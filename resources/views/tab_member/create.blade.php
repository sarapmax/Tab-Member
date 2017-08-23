@extends('layout.user')

@section('header-title', 'ลงทะเบียนสมาชิก')

@section('content')

<div class="card">
    <div class="card-body">
    	<form action="{{ route('tab_member.store') }}" method="POST" role="form" class="form-horizontal">
    		{{ csrf_field() }}
    		<fieldset>
    			<legend>ข้อมูลส่วนตัว</legend>
    			<div class="form-group">
    				<label class="control-label col-md-2">ชื่อ - นามสกุล : </label>
	    			<div class="col-md-3 {{ $errors->has('name_prefix_id') ? 'has-error' : '' }}">
	    				<select class="form-control" name="name_prefix_id">
	    					<option value="">เลือกคำนำหน้าชื่อ</option>
	    					@foreach(App\NamePrefix::orderBy('display_order', 'ASC')->get() as $name_prefix)
	    					<option @if($name_prefix->id == old('name_prefix_id')) selected @endif value="{{ $name_prefix->id }}">{{ $name_prefix->name }}</option>
	    					@endforeach
	    				</select>
	    				@if($errors->has('name_prefix_id'))
	    				<span class="help-block">{{ $errors->first('name_prefix_id') }}</span>
	    				@endif
	    			</div>
	    			<div class="col-md-3 {{ $errors->has('firstname') ? 'has-error' : '' }}">
	    				<input type="text" name="firstname" class="form-control" placeholder="ชื่อ" value="{{ old('firstname') }}">
	    				@if($errors->has('firstname'))
	    				<span class="help-block">{{ $errors->first('firstname') }}</span>
	    				@endif
	    			</div>
	    			<div class="col-md-3  {{ $errors->has('lastname') ? 'has-error' : '' }}">
	    				<input type="text" name="lastname" class="form-control" placeholder="นามสกุล"  value="{{ old('lastname') }}">
	    				@if($errors->has('lastname'))
	    				<span class="help-block">{{ $errors->first('lastname') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
				<div class="form-group {{ $errors->has('idcard') ? 'has-error' : '' }}">
					<label class="control-label col-md-2">หมายเลขบัตรประชาชน : </label>
					<div class="col-md-9">
						<input type="text" name="idcard" class="form-control" placeholder="หมายเลขบัตรประชาชน" value="{{ old('idcard') }}">
						@if($errors->has('idcard'))
							<span class="help-block">{{ $errors->first('idcard') }}</span>
						@endif
					</div>
				</div><br/>
    			<div class="form-group {{ $errors->has('old_no') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">หมายเลขสมาชิกเก่า : </label>
    				<div class="col-md-9">
	    				<input type="text" name="old_no" class="form-control" value="{{ old('old_no') }}" placeholder="หมายเลขสมาชิกเก่า">
	    				@if($errors->has('old_no'))
	    				<span class="help-block">{{ $errors->first('old_no') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">เพศ : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="gender">
	    					<option value="">เลือกเพศ</option>
	    					<option @if(old('gender') == 'ชาย') selected @endif value="ชาย">ชาย</option>
	    					<option @if(old('gender') == 'หญิง') selected @endif value="หญิง">หญิง</option>
	    				</select>
	    				@if($errors->has('gender'))
	    				<span class="help-block">{{ $errors->first('gender') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('birthday') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">วันเกิด : </label>
    				<div class="col-md-9">
	    				<input type="text" name="birthday" class="form-control datepicker" placeholder="วันเกิด" value="{{ old('birthday') }}">
	    				@if($errors->has('birthday'))
	    				<span class="help-block">{{ $errors->first('birthday') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group">
    				<label class="control-label col-md-2">สัญชาติ - เชื้อชาติ : </label>
	    			<div class="col-md-4 {{ $errors->has('nationality') ? 'has-error' : '' }}">
	    				<input type="text" name="nationality" class="form-control" placeholder="สัญชาติ" value="{{ old('nationality') }}">
	    				@if($errors->has('nationality'))
	    				<span class="help-block">{{ $errors->first('nationality') }}</span>
	    				@endif
	    			</div>
	    			<div class="col-md-4  {{ $errors->has('race') ? 'has-error' : '' }}">
	    				<input type="text" name="race" class="form-control" placeholder="เชื้อชาติ"  value="{{ old('race') }}">
	    				@if($errors->has('race'))
	    				<span class="help-block">{{ $errors->first('race') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('religion') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">ศาสนา : </label>
    				<div class="col-md-8">
	    				<input type="text" name="religion" class="form-control" value="{{ old('religion') }}" placeholder="ศาสนา">
	    				@if($errors->has('religion'))
	    				<span class="help-block">{{ $errors->first('religion') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    		</fieldset>

    		<fieldset>
    			<legend>ที่อยู่ตามบัตรประชาชน</legend>
    			<div class="form-group">
    				<label class="control-label col-md-2">ที่อยู่ : </label>
	    			<div class="col-md-2 {{ $errors->has('home_number') ? 'has-error' : '' }}">
	    				<input type="text" name="home_number" class="form-control" placeholder="บ้านเลขที่" value="{{ old('home_number') }}">
	    				@if($errors->has('home_number'))
	    				<span class="help-block">{{ $errors->first('home_number') }}</span>
	    				@endif
	    			</div>
	    			<div class="col-md-1  {{ $errors->has('moo') ? 'has-error' : '' }}">
	    				<input type="text" name="moo" class="form-control" placeholder="หมู่"  value="{{ old('moo') }}">
	    				@if($errors->has('moo'))
	    				<span class="help-block">{{ $errors->first('moo') }}</span>
	    				@endif
	    			</div>
	    			<div class="col-md-2  {{ $errors->has('village') ? 'has-error' : '' }}">
	    				<input type="text" name="village" class="form-control" placeholder="หมู่บ้าน/อาคาร/ชั้น/ตึก"  value="{{ old('village') }}">
	    				@if($errors->has('village'))
	    				<span class="help-block">{{ $errors->first('village') }}</span>
	    				@endif
	    			</div>
	    			<div class="col-md-2  {{ $errors->has('soi') ? 'has-error' : '' }}">
	    				<input type="text" name="soi" class="form-control" placeholder="ซอย/ตรอก"  value="{{ old('soi') }}">
	    				@if($errors->has('soi'))
	    				<span class="help-block">{{ $errors->first('soi') }}</span>
	    				@endif
	    			</div>
	    			<div class="col-md-2  {{ $errors->has('road') ? 'has-error' : '' }}">
	    				<input type="text" name="road" class="form-control" placeholder="ถนน"  value="{{ old('road') }}">
	    				@if($errors->has('road'))
	    				<span class="help-block">{{ $errors->first('road') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('province_id') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">จังหวัด :</label>
    				<div class="col-md-9">
	    				<select class="form-control" name="province_id" id="province">
	    					<option value="">เลือกจังหวัด</option>
	    					@foreach(App\Province::orderBy('code', 'ASC')->get() as $province)
	    					<option value="{{ $province->id }}">{{ $province->name }}</option>
	    					@endforeach
	    				</select>
	    				@if($errors->has('province_id'))
	    				<span class="help-block">{{ $errors->first('province_id') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('district_id') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">อำเภอ : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="district_id" id="district">
	    					<option value="">เลือกอำเภอ</option>
	    				</select>
	    				@if($errors->has('district_id'))
	    				<span class="help-block">{{ $errors->first('district_id') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('sub_district_id') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">ตำบล : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="sub_district_id" id="sub_district">
	    					<option value="">เลือกตำบล</option>
	    				</select>
	    				@if($errors->has('sub_district_id'))
	    				<span class="help-block">{{ $errors->first('sub_district_id') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('zipcode') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">รหัสไปรษณีย์ : </label>
    				<div class="col-md-9">
	    				<input type="text" id="zipcode" name="zipcode" class="form-control" placeholder="รหัสไปรษณีย์"  value="{{ old('zipcode') }}">
	    				@if($errors->has('zipcode'))
	    				<span class="help-block">{{ $errors->first('zipcode') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    		</fieldset>
    		<fieldset>
    			<legend>รายละเอียดอื่นๆ</legend>
    			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">อีเมล : </label>
    				<div class="col-md-9">
	    				<input type="text" name="email" class="form-control" placeholder="อีเมล"  value="{{ old('email') }}">
	    				@if($errors->has('email'))
	    				<span class="help-block">{{ $errors->first('email') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">เบอร์โทรศัพท์ : </label>
    				<div class="col-md-9">
	    				<input type="text" name="phone_number" class="form-control" placeholder="เบอร์โทรศัพท์ที่สามารถติดต่อได้"  value="{{ old('phone_number') }}">
	    				@if($errors->has('phone_number'))
	    				<span class="help-block">{{ $errors->first('phone_number') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('period_type') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">ประเภท : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="period_type">
	    					<option value="">เลือกประเภท</option>
	    					<option @if(old('period_type') == 'รายปี') selected @endif value="รายปี">รายปี</option>
	    					<option @if(old('period_type') == 'รายงวด') selected @endif value="รายงวด">รายงวด</option>
	    				</select>
	    				@if($errors->has('period_type'))
	    				<span class="help-block">{{ $errors->first('period_type') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('present_address') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">ที่อยุ่ปัจจุบัน : </label>
    				<div class="col-md-9">
						<textarea name="present_address" class="form-control" cols="30" rows="4" placeholder="กรอกที่อยู่ปัจจุบัน">{{ old('present_address') }}</textarea>
	    				@if($errors->has('present_address'))
	    				<span class="help-block">{{ $errors->first('present_address') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('blind_no') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">หมายเลขบัตรคนพิการ : </label>
    				<div class="col-md-9">
	    				<input type="text" name="blind_no" class="form-control" placeholder="หมายเลขบัตรคนพิการ"  value="{{ old('blind_no') }}">
	    				@if($errors->has('blind_no'))
	    				<span class="help-block">{{ $errors->first('blind_no') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('blind_level') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">ระดับการมองเห็น : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="blind_level">
	    					<option value="">เลือกระดับการมองเห็น</option>
	    					<option @if(old('blind_level') == 'ตาบอดสนิท') selected @endif value="ตาบอดสนิท">ตาบอดสนิท</option>
                            <option @if(old('blind_level') == 'มองเห็นเลือนลางแต่ไม่สามารถอ่านหนังสือตัวพิมพ์ปกติได้') selected @endif value="มองเห็นเลือนลางแต่ไม่สามารถอ่านหนังสือตัวพิมพ์ปกติได้">มองเห็นเลือนลางแต่ไม่สามารถอ่านหนังสือตัวพิมพ์ปกติได้</option>
                            <option @if(old('blind_level') == 'มองเห็นเลือนลางแต่สามารถอ่านหนังสือตัวพิมพ์ปกติได้โดยใช้แว่นสายตาหรืออุปกรณ์ช่วย') selected @endif value="มองเห็นเลือนลางแต่สามารถอ่านหนังสือตัวพิมพ์ปกติได้โดยใช้แว่นสายตาหรืออุปกรณ์ช่วย">มองเห็นเลือนลางแต่สามารถอ่านหนังสือตัวพิมพ์ปกติได้โดยใช้แว่นสายตาหรืออุปกรณ์ช่วย</option>

	    				</select>
	    				@if($errors->has('blind_level'))
	    				<span class="help-block">{{ $errors->first('blind_level') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('blind_cause') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">สาเหตุความพิการ : </label>
    				<div class="col-md-9">
    					<textarea class="form-control" name="blind_cause" placeholder="สาเหตุความพิการ">{{ old('blind_cause') }}</textarea>
	    				@if($errors->has('blind_cause'))
	    				<span class="help-block">{{ $errors->first('blind_cause') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('education_level') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">ระดับการศึกษา : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="education_level">
	    					<option value="">เลือกระดับการศึกษา</option>
	    					<option @if(old('education_level') == 'ประถมศึกษา') selected @endif value="ประถมศึกษา">ประถมศึกษา</option>
                            <option @if(old('education_level') == 'มัธยมตอนต้น') selected @endif value="มัธยมตอนต้น">มัธยมตอนต้น</option>
                            <option @if(old('education_level') == 'มัธยมตอนปลาย') selected @endif value="มัธยมตอนปลาย">มัธยมตอนปลาย</option>
                            <option @if(old('education_level') == 'ปริญญาตรี') selected @endif value="ปริญญาตรี">ปริญญาตรี</option>
                            <option @if(old('education_level') == 'ปริญญาโท') selected @endif value="ปริญญาโท">ปริญญาโท</option>
                            <option @if(old('education_level') == 'ปริญญาเอก') selected @endif value="ปริญญาเอก">ปริญญาเอก</option>
                            <option @if(old('education_level') == 'ประกาศนียบัตรวิชาชีพ') selected @endif value="ประกาศนียบัตรวิชาชีพ">ประกาศนียบัตรวิชาชีพ</option>
                            <option @if(old('education_level') == 'ประกาศนียบัตรวิชาชีพชั้นสูง') selected @endif value="ประกาศนียบัตรวิชาชีพชั้นสูง">ประกาศนียบัตรวิชาชีพชั้นสูง</option>
                            <option @if(old('education_level') == 'อื่นๆ') selected @endif value="อื่นๆ">อื่นๆ</option>
	    				</select>
	    				@if($errors->has('education_level'))
	    				<span class="help-block">{{ $errors->first('education_level') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('education_name') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">จบจากสถานศึกษา : </label>
    				<div class="col-md-9">
	    				<input type="text" name="education_name" class="form-control" placeholder="จบจากสถานศึกษา"  value="{{ old('education_name') }}">
	    				@if($errors->has('education_name'))
	    				<span class="help-block">{{ $errors->first('education_name') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">สถานภาพ : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="status">
	    					<option value="">เลือกสถานภาพ</option>
	    					<option @if(old('status') == 'โสด') selected @endif  value="โสด">โสด</option>
                            <option @if(old('status') == 'สมรส') selected @endif  value="สมรส">สมรส</option>
                            <option @if(old('status') == 'อย่าร้าง') selected @endif  value="อย่าร้าง">อย่าร้าง</option>
                            <option @if(old('status') == 'คู่สมรสเสียชีวิตแล้ว') selected @endif  value="คู่สมรสเสียชีวิตแล้ว">คู่สมรสเสียชีวิตแล้ว</option>
	    				</select>
	    				@if($errors->has('status'))
	    				<span class="help-block">{{ $errors->first('status') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('career') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">อาชีพ : </label>
    				<div class="col-md-9">
	    				<input type="text" name="career" class="form-control" placeholder="อาชีพ"  value="{{ old('career') }}">
	    				@if($errors->has('career'))
	    				<span class="help-block">{{ $errors->first('career') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('training') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">หลักสูตรอบรม : </label>
    				<div class="col-md-9">
    					<textarea class="form-control" name="training" placeholder="หลักสูตรอบรม">{{ old('training') }}</textarea>
	    				@if($errors->has('training'))
	    				<span class="help-block">{{ $errors->first('training') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('salary') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">รายได้เฉลี่ยต่อเดือน : </label>
    				<div class="col-md-9">
	    				<input type="text" name="salary" class="form-control" placeholder="รายได้เฉลี่ยต่อเดือน"  value="{{ old('salary') }}">
	    				@if($errors->has('salary'))
	    				<span class="help-block">{{ $errors->first('salary') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('guarantor_type') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">สมัครเป็นสมาชิกสามัญประเภท : </label>
    				<div class="col-md-9">
	    				<select class="form-control" name="guarantor_type">
	    					<option value="">เลือกประเภท</option>
	    					<option @if(old('guarantor_type') == 'บุคคลสามัญ') selected @endif value="บุคคลสามัญ">บุคคลสามัญ</option>
                            <option @if(old('guarantor_type') == 'บุคคลวิสามัญ') selected @endif value="บุคคลวิสามัญ">บุคคลวิสามัญ</option>
                            <option @if(old('guarantor_type') == 'บุคคลกิติมศักดิ์') selected @endif value="บุคคลกิติมศักดิ์">บุคคลกิติมศักดิ์</option>
                            <option @if(old('guarantor_type') == 'นิติบุคคลสามัญ') selected @endif value="นิติบุคคลสามัญ">นิติบุคคลสามัญ</option>
                            <option @if(old('guarantor_type') == 'นิติบุคคลวิสามัญ') selected @endif value="นิติบุคคลวิสามัญ">นิติบุคคลวิสามัญ</option>
                            <option @if(old('guarantor_type') == 'นิติบุคคลกิติมศักดิ์') selected @endif value="นิติบุคคลกิติมศักดิ์">นิติบุคคลกิติมศักดิ์</option>
                            <option @if(old('guarantor_type') == 'คณะบุคคลสามัญ') selected @endif value="คณะบุคคลสามัญ">คณะบุคคลสามัญ</option>
                            <option @if(old('guarantor_type') == 'คณะบุคคลวิสามัญ') selected @endif value="คณะบุคคลวิสามัญ">คณะบุคคลวิสามัญ</option>
                            <option @if(old('guarantor_type') == 'คณะบุคคลกิติมศักดิ์') selected @endif value="คณะบุคคลกิติมศักดิ์">คณะบุคคลกิติมศักดิ์</option>

	    				</select>
	    				@if($errors->has('guarantor_type'))
	    				<span class="help-block">{{ $errors->first('guarantor_type') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group {{ $errors->has('guarantor_name') ? 'has-error' : '' }}">
    				<label class="control-label col-md-2">สมาชิกสามัญผู้รับรองคุณสมบัติ : </label>
    				<div class="col-md-9">
	    				<input type="text" name="guarantor_name" class="form-control" placeholder="สมาชิกสามัญผู้รับรองคุณสมบัติ"  value="{{ old('guarantor_name') }}">
	    				@if($errors->has('guarantor_name'))
	    				<span class="help-block">{{ $errors->first('guarantor_name') }}</span>
	    				@endif
	    			</div>
    			</div><br/>
    			<div class="form-group">
    				<div class="col-md-offset-2 col-md-10">
    					<button type="submit" class="btn btn-primary"><em class="ion-android-checkbox-outline"></em> บันทึกข้อมูล</button>
						<input type="reset" class="btn btn-default" value="Clear">
    				</div>
    			</div>
    		</fieldset>
    	</form>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">
	var province_id = '{{ old('province_id') }}';
	var district_id = '{{ old('district_id') }}';
    var sub_district_id = '{{ old('sub_district_id') }}';
    var zipcode_id = '{{ old('zipcode_id') }}';
    
    $('select#province').val(province_id).prop('selected', true);

    districtUpdate(province_id);
    subDistrictUpdate(district_id);
    zipcodeUpdate(sub_district_id);

    $("select#province").change(function(e){  
        var province_id = e.target.value;
        district_id = false;
        sub_district_id = false;
        districtUpdate(province_id);
    });

    $("select#district").change(function(e){  
        var district_id = e.target.value;
        sub_district_id = false;
        subDistrictUpdate(district_id);
    });

    $("select#sub_district").change(function(e) {
    	var sub_district_id = e.target.value;
    	zipcode_id = false;
    	zipcodeUpdate(sub_district_id);
    });

    function districtUpdate(province_id) {
    	if(province_id) {
    		$.get('{{ url('api/update_district_by_province/') }}/' + province_id , function (data) {
	            $('select#district').empty();
	            for(var i = 0; i < data.length; i++) {
	            	    $('select#district').append($('<option>', {
	                    value: data[i].id,
	                    text: data[i].name
	                }));
	            }
	            if (district_id) {
	                $('select#district').val(district_id).prop('selected', true);
	            }else {
	            	subDistrictUpdate(data[0].id)
	            }
	        });
    	}else {
    		$('select#district').find('option').remove().end().append('<option value="">เลือกอำเภอ</option>')
    		$('select#sub_district').find('option').remove().end().append('<option value="">เลือกตำบล</option>')
    		$('input#zipcode').val(null)
    	}
    }

    function subDistrictUpdate(district_id) {
    	if(district_id) {
    		$.get('{{ url('api/update_sub_district_by_district/') }}/' + district_id , function (data) {
	            $('select#sub_district').empty();
	            for(var i = 0; i < data.length; i++) {
	            	    $('select#sub_district').append($('<option>', {
	                    value: data[i].id,
	                    text: data[i].name
	                }));
	            }
	            if (sub_district_id) {
	                $('select#sub_district').val(sub_district_id).prop('selected', true);
	            }else {
	            	zipcodeUpdate(data[0].id);
	            }
	        });
    	}
    }

    function zipcodeUpdate(sub_district_id) {
    	if(sub_district_id) {
    		$.get('{{ url('api/update_zipcode_by_sub_district/') }}/' + sub_district_id , function (data) {
    			$('input#zipcode').val(data.zipcode)
    		})
    	}
    }
</script>

@endsection
