@extends('layout.master')

@section('app')

<div class="layout-container">
	<div class="page-container bg-blue-700">
		<div class="container-full">
			<div class="container container-xs" style="padding-top: 100px;">
			<h4 class="mv-lg" style="text-align: center;">TAB Member System</h4>
			<div class="container container-xs">
				<form id="user-login" action="{{ url('login') }}" method="POST" role="form" class="card form-horizontal">
					{{ csrf_field() }}
				 	<div class="card-heading">
				    	<div class="card-title text-center"><em class="ion-log-in"> </em>  เข้าสู่ระบบ</div>
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

		    			<div class="mda-form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
                      			<input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                      			<div class="mda-form-control-line"></div>
                      			<label for="password" class="control-label" style="font-size:1em;"><em class="ion-android-create"> </em> รหัสผ่าน</label>
                    		</div>
                    		@if($errors->has('password'))
		                    <span class="help-block">{{ $errors->first('password') }}</span>
		                    @endif
                  		</div>
                  		<div class="checkbox c-checkbox">
                        	<label>
                          		<input type="checkbox" name="remember_token"><span class="ion-checkmark-round"></span>จดจำฉันในครั้งต่อไป</a>
                        	</label>
                      	</div><br/><br/>

                  		<div class="mda-form-group">
                      		<button type="submit" class="btn btn-primary btn-block"><em class="ion-log-in"> </em> เข้าสู่ระบบ</button>
                  		</div>
				  	</div>
				</form>
				<div class="text-center text-sm">
					<a href="{{ url('register') }}" class="text-inherit">สมัครสมาชิก</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="{{ url('forgot_password') }}" class="text-inherit">ลืมรหัสผ่าน ?</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection