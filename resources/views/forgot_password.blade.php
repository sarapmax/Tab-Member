@extends('layout.master')

@section('app')

<div class="layout-container">
	<div class="page-container bg-blue-700">
		<div class="container-full">
			<div class="container container-xs" style="padding-top: 100px;">
			<h4 class="mv-lg" style="text-align: center;">TAB Member System</h4>
			<div class="container container-xs">
				<form id="user-login" action="{{ url('forgot_password') }}" method="POST" role="form" class="card form-horizontal">
					{{ csrf_field() }}
				 	<div class="card-heading">
				    	<div class="card-title text-center"><em class="ion-key"> </em> ลืมรหัสผ่าน</div>
				  	</div>
				  	<div class="card-body">
				    	<div class="mda-form-group {{ $errors->has('email') ? 'has-error' : '' }}">
		                   	<div class="mda-form-control">
		                      	<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
		                      	<div class="mda-form-control-line"></div>
		                      	<label for="email" class="control-label" style="font-size:1em;"><em class="ion-android-person"> </em> อีเมล์</label>
		                    </div>
		                    @if($errors->has('email'))
		                    <span class="help-block">{{ $errors->first('email') }}</span>
		                    @endif
		                </div>

                  		<div class="mda-form-group">
                      		<button type="submit" class="btn btn-primary btn-block"><em class="ion-android-checkbox-outline"> </em>  ยืนยัน</button>
                  		</div>
				  	</div>
				</form>
				<div class="text-center text-sm">
					<a href="{{ url('login') }}" class="text-inherit">เข้าสู่ระบบ</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
