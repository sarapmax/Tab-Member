@extends('layout.user')

@section('header-title', 'เพิ่มผู้ใช้')

@section('content')

<div class="card">
    <div class="card-body">
    	<form style="margin: 30px 0;" action="{{ url('register') }}" method="POST" role="form" class="form-horizontal">
			{{ csrf_field() }}
	    	<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
	    		<label for="email" class="control-label col-md-2">อีเมล์</label>
               	<div class="col-md-8">
                  	<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                  	@if($errors->has('email'))
	                	<span class="help-block">{{ $errors->first('email') }}</span>
	                @endif
                </div>
            </div>

			<div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
				<label for="password" class="control-label col-md-2">รหัสผ่าน</label>
        		<div class="col-md-8">
          			<input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
          			@if($errors->has('password'))
		                <span class="help-block">{{ $errors->first('password') }}</span>
	                @endif
        		</div>
      		</div>

      		<div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
      			<label for="password_confirmation" class="control-label col-md-2">ยืนยันรหัสผ่าน</label>
        		<div class="col-md-8">
          			<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
          			@if($errors->has('password_confirmation'))
	                	<span class="help-block">{{ $errors->first('password_confirmation') }}</span>
	                @endif
        		</div>
      		</div>

      		<div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
      			<label for="firstname" class="control-label col-md-2">ชื่อ</label>
        		<div class="col-md-8">
          			<input type="firstname" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
	        		@if($errors->has('firstname'))
                		<span class="help-block">{{ $errors->first('firstname') }}</span>
	                @endif
                </div>
      		</div>

      		<div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
      			<label for="lastname" class="control-label col-md-2">นามสกุล</label>
        		<div class="col-md-8">
          			<input type="lastname" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
          			@if($errors->has('lastname'))
		                <span class="help-block">{{ $errors->first('lastname') }}</span>
		            @endif
        		</div>
      		</div>

      		<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
      			<label for="phone_number" class="control-label col-md-2">เบอร์โทรศัพท์มือถือ</label>
      			<div class="col-md-8">
          			<input type="phone_number" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
	        		@if($errors->has('phone_number'))
	                	<span class="help-block">{{ $errors->first('phone_number') }}</span>
	                @endif
            	</div>
      		</div>

      		<div class="form-group {{ $errors->has('branch') ? 'has-error' : '' }}">
      			<label for="branch" class="control-label col-md-2">สาขา</label>
        		<div class="col-md-8">
          			<input type="branch" name="branch" id="branch" class="form-control" value="{{ old('branch') }}">
          			@if($errors->has('branch'))
		                <span class="help-block">{{ $errors->first('branch') }}</span>
		            @endif
        		</div>
      		</div>

      		<div class="form-group {{ $errors->has('admin') ? 'has-error' : '' }}">
        		<label for="admin" class="control-label col-md-2">สถานะผู้ใช้</label>
        		<div class="col-md-8">
        			<div class="radio">
        				<label><input type="radio" @if(old('admin') == 0) checked @endif name="admin" value="0">ผู้ใช้</label>
        			</div>
        			<div class="radio">
        				<label><input type="radio" @if(old('admin') == 1) checked @endif name="admin" value="1">แอดมิน</label>
        			</div>
        		</div>
        		@if($errors->has('admin'))
                <span class="help-block">{{ $errors->first('admin') }}</span>
                @endif
      		</div>
      		
      		<div class="form-group">
      			<div class="col-md-offset-2 col-md-8">
	                <input type="hidden" name="active" value="1">
	                <a href="{{ url('manage_user') }}" class="btn btn-default"><i class="fa fa-arrow-left"> </i> กลับ</a>
	          		<button type="submit" class="btn btn-primary"><em class="ion-android-checkbox-outline"> </em> เพิ่มผู้ใช้</button>
          		</div>
      		</div>
		</form>
    </div>
</div>

@endsection
