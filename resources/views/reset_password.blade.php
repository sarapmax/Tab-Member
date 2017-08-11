@extends('layout.master')

@section('app')

<div class="layout-container">
	<div class="page-container bg-blue-700">
		<div class="container-full">
			<div class="container container-xs" style="padding-top: 100px;">
			<h4 class="mv-lg" style="text-align: center;">TAB Member System</h4>
			<div class="container container-xs">
				<form id="user-login" action="{{ url('reset_password') }}" method="POST" role="form" class="card form-horizontal">
					{{ csrf_field() }}
					@if ($errors->any())
						<div class="alert alert-danger">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
				 	<div class="card-heading">
				    	<div class="card-title text-center"><em class="ion-key"> </em> เปลี่ยนรหัสผ่าน</div>
				  	</div>
				  	<div class="card-body">
						<div class="mda-form-group {{ $errors->has('email') ? 'has-error' : '' }}">
							<div class="mda-form-control">
								<input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
								<div class="mda-form-control-line"></div>
								<label for="email" class="control-label" style="font-size:1em;">อีเมล</label>
							</div>
							@if($errors->has('email'))
								<span class="help-block">{{ $errors->first('email') }}</span>
							@endif
						</div>
				    	<div class="mda-form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
                      			<input type="password" name="password" id="password" class="form-control">
                      			<div class="mda-form-control-line"></div>
                      			<label for="password" class="control-label" style="font-size:1em;">รหัสผ่าน</label>
                    		</div>
                    		@if($errors->has('password'))
		                    <span class="help-block">{{ $errors->first('password') }}</span>
		                    @endif
                  		</div>


                  		<div class="mda-form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
                      			<input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                      			<div class="mda-form-control-line"></div>
                      			<label for="password_confirmation" class="control-label" style="font-size:1em;">ยืนยันรหัสผ่าน</label>
                    		</div>
                    		@if($errors->has('password_confirmation'))
		                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
		                    @endif
                  		</div>

                  		<div class="mda-form-group">
							<input type="hidden" name="token" value="{{ $token }}">
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
