@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก &raquo; สวัสดิการ &raquo; ' . $tab_member->name_prefix->name . ' ' . $tab_member->firstname . ' ' . $tab_member->lastname)

@section('content')

<div class="card">
    <div class="card-body">
        <table id="datatable1" class="table-datatable table table-striped table-hover mv-lg">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ประเภทการเบิก</th>
                    <th>ชื่อผู้ขอเบิก</th>
                    <th>เบอร์ติดต่อ</th>
                    <th>จำนวนเงิน</th>
                    <th>วันที่เบิก</th>
                    <th>ผู้ทำรายการ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($welfares as $i => $welfare)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $welfare->type }}</td>
                    <td>{{ $welfare->withdraw_firstname . ' ' . $welfare->withdraw_lastname }}</td>
                    <td>{{ $welfare->withdraw_phone_number }}</td>
                    <td>{{ number_format($welfare->amount) }}</td>
                    <td>{{ $welfare->created_at->format('d/m/Y') }}</td>
                    <td>{{ $welfare->user->firstname . ' ' . $welfare->user->lastname }}</td>
                    <td>
                        <form action="{{ route('welfare.destroy', $welfare->id) }}" method="POST" style="display:inline" onsubmit="return confirm('คุณแน่ใจใช่ไหม ?')">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" data-toggle="tooltip" data-title="ลบ" class="btn btn-danger btn-sm"><em class="ion-trash-b"></em></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('welfare.store') }}" method="POST" role="form" class="form-horizontal">
            <input type="hidden" name="tab_member_no" value="{{ $tab_member->no }}">
            {{ csrf_field() }}
            <fieldset>
                <legend>แบบฟอร์มเบิกจ่ายสวัสดิการ</legend>
                <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">ประเภทการเบิกสวัสดิการ : </label>
                    <div class="col-md-9">
                        <select class="form-control" name="type">
                            <option value="">เลือกประเภทการเบิกสวัสดิการ</option>
                            <option @if(old('type') == 'เบิกค่ารักษาพยาบาล') selected @endif value="เบิกค่ารักษาพยาบาล">เบิกค่ารักษาพยาบาล</option>
                            <option @if(old('type') == 'เบิกฌาปนกิจสงเคราะห์') selected @endif value="เบิกฌาปนกิจสงเคราะห์">เบิกฌาปนกิจสงเคราะห์</option>
                            <option @if(old('type') == 'ช่วยเหลือกรณีฉุกเฉิน') selected @endif value="ช่วยเหลือกรณีฉุกเฉิน">ช่วยเหลือกรณีฉุกเฉิน</option>
                        </select>
                        @if($errors->has('type'))
                        <span class="help-block">{{ $errors->first('type') }}</span>
                        @endif
                    </div>
                </div><br/>
                <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">จำนวนเงิน : </label>
                    <div class="col-md-9">
                        <input type="text" name="amount" class="form-control" placeholder="จำนวนเงิน" value="{{ old('amount') }}">
                        @if($errors->has('amount'))
                        <span class="help-block">{{ $errors->first('amount') }}</span>
                        @endif
                    </div>
                </div><br/>
                <div class="form-group">
                    <label class="control-label col-md-2">ชื่อ - นามสกุล : </label>
                    <div class="col-md-5 {{ $errors->has('withdraw_firstname') ? 'has-error' : '' }}">
                        <input type="text" name="withdraw_firstname" class="form-control" placeholder="ชื่อ" value="{{ old('withdraw_firstname') }}">
                        @if($errors->has('withdraw_firstname'))
                        <span class="help-block">{{ $errors->first('withdraw_firstname') }}</span>
                        @endif
                    </div>
                    <div class="col-md-4  {{ $errors->has('withdraw_lastname') ? 'has-error' : '' }}">
                        <input type="text" name="withdraw_lastname" class="form-control" placeholder="นามสกุล"  value="{{ old('withdraw_lastname') }}">
                        @if($errors->has('withdraw_lastname'))
                        <span class="help-block">{{ $errors->first('withdraw_lastname') }}</span>
                        @endif
                    </div>
                </div><br/>
                <div class="form-group {{ $errors->has('withdraw_phone_number') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">เบอร์โทรศัพท์ : </label>
                    <div class="col-md-9">
                        <input type="text" name="withdraw_phone_number" class="form-control" placeholder="เบอร์โทรศัพท์ที่สามารถติดต่อได้ " value="{{ old('withdraw_phone_number') }}">
                        @if($errors->has('withdraw_phone_number'))
                        <span class="help-block">{{ $errors->first('withdraw_phone_number') }}</span>
                        @endif
                    </div>
                </div><br/>
                <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">บันทึก : </label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="comment" placeholder="รายละเอียดเพิ่มเติม">{{ old('comment') }}</textarea>
                        @if($errors->has('comment'))
                        <span class="help-block">{{ $errors->first('comment') }}</span>
                        @endif
                    </div>
                </div><br/>
                <div class="form-group">
                    <div class="col-md-offset-2 col-md-9">
                        <button type="submit" class="btn btn-primary"><em class="ion-android-checkbox-outline"></em> บันทึกข้อมูล</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

@endsection