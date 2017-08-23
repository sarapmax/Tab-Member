@extends('layout.user')

@section('header-title', 'รายงาน')

@section('content')

<div class="card">
    <div class="card-body">
    	<form action="{{ url('member_report') }}" class="form-horizontal" method="POST" role="form">
    		{{ csrf_field() }}
    		<fieldset>
    			<legend><em class="ion-document-text"></em> รายงานข้อมูลสมาชิก</legend>
    		
    		<div class="form-group">
				<label for="" class="control-label col-md-2">ภูมิภาค:</label>
				<div class="col-md-6">
					<select name="geography_id" id="geography" class="form-control">
						<option value="">เลือกภูมิภาค</option>
						@foreach(App\Geography::all() as $geography)
    					<option value="{{ $geography->id }}">{{ $geography->name }}</option>
    					@endforeach
					</select>
				</div>
            </div><br/>
            <div class="form-group">
				<label for="" class="control-label col-md-2">จังหวัด:</label>
				<div class="col-md-6">
					<select name="province_id" id="province" class="form-control">
						<option value="">เลือกจังหวัด</option>
					</select>
				</div>
            </div><br/>
			<div class="form-group">
				<label class="control-label col-md-2">ประเภทสมาชิก : </label>
				<div class="col-md-6">
					<select class="form-control" name="period_type">
						<option value="">เลือกประเภท</option>
						<option value="รายปี">รายปี</option>
						<option value="รายงวด">รายงวด</option>
					</select>
				</div>
			</div><br/>
            <div class="form-group">
				<label for="" class="control-label col-md-2">ระดับการมองเห็น:</label>
				<div class="col-md-6">
					<select name="blind_level" id="" class="form-control">
						<option value="">เลือกระดับการมองเห็น</option>
						<option value="ตาบอดสนิท">ตาบอดสนิท</option>
                        <option value="มองเห็นเลือนลางแต่ไม่สามารถอ่านหนังสือตัวพิมพ์ปกติได้">มองเห็นเลือนลางแต่ไม่สามารถอ่านหนังสือตัวพิมพ์ปกติได้</option>
                        <option value="มองเห็นเลือนลางแต่สามารถอ่านหนังสือตัวพิมพ์ปกติได้โดยใช้แว่นสายตาหรืออุปกรณ์ช่วย">มองเห็นเลือนลางแต่สามารถอ่านหนังสือตัวพิมพ์ปกติได้โดยใช้แว่นสายตาหรืออุปกรณ์ช่วย</option>
					</select>
				</div>
            </div><br/>
			<div class="form-group">
				<label class="control-label col-md-2">ระดับการศึกษา : </label>
				<div class="col-md-6">
					<select class="form-control" name="education_level">
						<option value="">เลือกระดับการศึกษา</option>
						<option value="ประถมศึกษา">ประถมศึกษา</option>
						<option value="มัธยมตอนต้น">มัธยมตอนต้น</option>
						<option value="มัธยมตอนปลาย">มัธยมตอนปลาย</option>
						<option value="ปริญญาตรี">ปริญญาตรี</option>
						<option value="ปริญญาโท">ปริญญาโท</option>
						<option value="ปริญญาเอก">ปริญญาเอก</option>
						<option value="ประกาศนียบัตรวิชาชีพ">ประกาศนียบัตรวิชาชีพ</option>
						<option value="ประกาศนียบัตรวิชาชีพชั้นสูง">ประกาศนียบัตรวิชาชีพชั้นสูง</option>
						<option value="อื่นๆ">อื่นๆ</option>
					</select>
				</div>
			</div><br/>
			<div class="form-group">
				<label class="control-label col-md-2">เพศ : </label>
				<div class="col-md-6">
					<select class="form-control" name="gender">
						<option value="">เลือกเพศ</option>
						<option value="ชาย">ชาย</option>
						<option value="หญิง">หญิง</option>
					</select>
				</div>
			</div><br/>
			<div class="form-group">
				<label for="start-age" class="control-label col-md-2">ช่วงอายุ (ปี):</label>
				<div class="col-md-3">
					<select name="start_age" id="start-age" class="form-control">
						<option value="">เลือกช่วงอายุเริ่มต้น</option>
					</select>
				</div>
				<div class="col-md-3">
					<select name="end_age" id="end-age" class="form-control">
						<option value="">เลือกช่วงอายุสิ้นสุด</option>
					</select>
				</div>
			</div><br/>
            <div class="form-group {{ $errors->has('report_type') ? 'has-error' : '' }}">
				<label for="" class="control-label col-md-2">รูปแบบรายงาน:</label>
				<div class="col-md-6">
					<label style="margin-top: 8px;"><input type="radio" name="report_type" value="xls"> Excel</label> &nbsp;&nbsp;&nbsp;
					<label style="margin-top: 8px;"><input type="radio" name="report_type" value="pdf"> PDF</label>
					@if($errors->has('report_type'))
						<br/>
						<span class="help-block">{{ $errors->first('report_type') }}</span>
					@endif
				</div>
            </div><br/>
            <div class="form-group">
            	<div class="col-md-offset-2 col-md-6">
            		<button type="submit" class="btn btn-primary">ออกรายงาน</button>
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
	$("select#geography").change(function(e){  
        var geography_id = e.target.value;
        provinceUpdate(geography_id);
    });

    function provinceUpdate(geography_id) {
    	if(geography_id) {
    		$.get('{{ url('api/update_province_by_geography/') }}/' + geography_id , function (data) {
	            $('select#province').empty();
	            $('select#province').append($('<option>', {
	            	value: '',
	            	text: 'เลือกจังหวัด',
	            }));
	    		for(var i = 0; i < data.length; i++) {
	            	    $('select#province').append($('<option>', {
	                    value: data[i].id,
	                    text: data[i].name
	                }));
	            }
	        })
    	}else {
    		$('select#province').find('option').remove().end().append('<option value="">เลือกจังหวัด</option>')
    	}
    }

    var $startAge = $('#start-age');
    var $endAge = $('#end-age');

    for(var start_age = 1; start_age <= 150; start_age++) {
        $startAge.append($('<option>', {
            value: start_age,
			text: start_age
		}));
	}

    $startAge.change(function() {
        $endAge.empty();

        for(var end_age = $(this).val(); end_age <= 150; end_age++) {
            $endAge.append($('<option>', {
                value: end_age,
                text: end_age
            }));
		}
	});
</script>

@endsection
