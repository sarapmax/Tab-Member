@extends('layout.master')

@section('app')

<div class="layout-container">
	<div class="page-container bg-blue-700">
		<div class="container-full">
			<div class="container container-xs" style="padding-top: 10px;">
			<h4 class="mv-lg" style="text-align: center;">TAB Member System</h4>
			<div class="container container-xs">
				<form id="user-register" action="{{ url('register') }}" method="POST" role="form" class="card form-horizontal">
					{{ csrf_field() }}
				 	<div class="card-heading">
				    	<div class="card-title text-center"><em class="ion-edit"> </em> สมัครสมาชิก</div>
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
                      			<input type="password" name="password" id="password" class="form-control" value="{{ old('password') }}">
                      			<div class="mda-form-control-line"></div>
                      			<label for="password" class="control-label" style="font-size:1em;">รหัสผ่าน</label>
                    		</div>
                    		@if($errors->has('password'))
		                    <span class="help-block">{{ $errors->first('password') }}</span>
		                    @endif
                  		</div>

                  		<div class="mda-form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
                      			<input type="password" name="password_confirmation" id="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                      			<div class="mda-form-control-line"></div>
                      			<label for="password_confirmation" class="control-label" style="font-size:1em;">ยืนยันรหัสผ่าน</label>
                    		</div>
                    		@if($errors->has('password_confirmation'))
		                    <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
		                    @endif
                  		</div>

                  		<div class="mda-form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
                      			<input type="firstname" name="firstname" id="firstname" class="form-control" value="{{ old('firstname') }}">
                      			<div class="mda-form-control-line"></div>
                      			<label for="firstname" class="control-label" style="font-size:1em;">ชื่อ</label>
                    		</div>
                    		@if($errors->has('firstname'))
		                    <span class="help-block">{{ $errors->first('firstname') }}</span>
		                    @endif
                  		</div>

                  		<div class="mda-form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
                      			<input type="lastname" name="lastname" id="lastname" class="form-control" value="{{ old('lastname') }}">
                      			<div class="mda-form-control-line"></div>
                      			<label for="lastname" class="control-label" style="font-size:1em;">นามสกุล</label>
                    		</div>
                    		@if($errors->has('lastname'))
		                    <span class="help-block">{{ $errors->first('lastname') }}</span>
		                    @endif
                  		</div>

                  		<div class="mda-form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
                      			<input type="phone_number" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
                      			<div class="mda-form-control-line"></div>
                      			<label for="phone_number" class="control-label" style="font-size:1em;">เบอร์โทรศัพท์มือถือ</label>
                    		</div>
                    		@if($errors->has('phone_number'))
		                    <span class="help-block">{{ $errors->first('phone_number') }}</span>
		                    @endif
                  		</div>

                  		<div class="mda-form-group {{ $errors->has('geography_id') ? 'has-error' : '' }}">
                    		<div class="mda-form-control">
								<select class="form-control" name="geography_id">
									<option value="">-- เลือกสาขา --</option>
									@foreach(App\Geography::all() as $geography)
										<option value="{{ $geography->id }}" @if(old('geography_id') == $geography->id) selected @endif>สาขา {{ $geography->name }}</option>
									@endforeach
								</select>
                      			<div class="mda-form-control-line"></div>
                      			<label for="geography_id" class="control-label" style="font-size:1em;">สาขา</label>
                    		</div>
                    		@if($errors->has('geography_id'))
		                    <span class="help-block">{{ $errors->first('geography_id') }}</span>
		                    @endif
                  		</div>
                  		
						<div class="mda-form-group">
							<div class="row">
								<div class="col-md-6">
									<input type="hidden" name="admin" value="0">
									<input type="hidden" name="active" value="0">
									<button type="submit" class="btn btn-primary btn-block btn-sm">ตกลง</button>
								</div>
								<div class="col-md-6">
									<input type="reset" class="btn btn-default btn-block btn-sm" value="Clear">
								</div>
							</div>
						</div>
				  	</div>
				</form>
				<div class="text-center" style="font-size: 16px;">
					<a href="{{ url('login') }}" style="text-decoration: underline;" class="text-inherit">เข้าสู่ระบบ</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
