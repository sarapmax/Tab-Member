@extends('layout.user')

@section('header-title', 'Import รายงาน')

@section('content')

<div class="card">
    <div class="card-body">
    	<br/>
    	<form action="{{ url('import') }}" class="form-horizontal" method="POST" role="form" enctype="multipart/form-data">
    		{{ csrf_field() }}
    		<fieldset>
	    		<div class="form-group">
					<label for="" class="control-label col-md-2">ไฟล์ข้อมูล :</label>
					<div class="col-md-6">
						<input type="file" name="import_file" class="form-control">
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-primary">บันทึก</button>
					</div>
	            </div>
            </fieldset>
    	</form>
    </div>
</div>

@endsection