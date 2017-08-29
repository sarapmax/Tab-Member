@extends('layout.user')

@section('header-title', 'แก้ไขค่าบำรุงสมาชิก')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('service_fee.update', $serviceFee->id) }}" method="POST" role="form" class="form-horizontal">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="tab_member_no" value="{{ $serviceFee->tab_member_no }}">
                {{ csrf_field() }}
                <fieldset>
                    <legend>แบบฟอร์มค่าบำรุงสมาชิก</legend>
                    <div class="form-group">
                        <label class="control-label col-md-2">ชื่อ - นามสกุล : </label>
                        <div class="col-md-5 {{ $errors->has('firstname') ? 'has-error' : '' }}">
                            <input type="text" name="firstname" class="form-control" placeholder="ชื่อ" value="{{ old('firstname', $serviceFee->firstname) }}">
                            @if($errors->has('firstname'))
                                <span class="help-block">{{ $errors->first('firstname') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4  {{ $errors->has('lastname') ? 'has-error' : '' }}">
                            <input type="text" name="lastname" class="form-control" placeholder="นามสกุล"  value="{{ old('lastname', $serviceFee->lastname) }}">
                            @if($errors->has('lastname'))
                                <span class="help-block">{{ $errors->first('lastname') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label for="" class="col-md-2 control-label"></label>
                        <div class="col-md-8">
                            <div>
                                <label>
                                    <input type="radio" value="ค่าบำรุงสมาชิกรายปี (1 ปี) 20 บาท" name="type" @if(old('type', $serviceFee->type) == 'ค่าบำรุงสมาชิกรายปี (1 ปี) 20 บาท') checked @endif> &nbsp;&nbsp;ค่าบำรุงสมาชิกรายปี (1 ปี) 20 บาท
                                </label><br/>
                                <label>
                                    <input type="radio" value="ค่าบำรุงสมาชิกรายงวด (4 ปี) 80 บาท" name="type" @if(old('type', $serviceFee->type) == 'ค่าบำรุงสมาชิกรายงวด (4 ปี) 80 บาท') checked @endif> &nbsp;&nbsp;ค่าบำรุงสมาชิกรายงวด (4 ปี) 80 บาท
                                </label><br/>
                                <label>
                                    <input type="radio" value="อื่นๆ" name="type" @if(old('type', $serviceFee->type) == 'อื่นๆ') checked @endif> &nbsp;&nbsp;อื่นๆ
                                </label>
                            </div>
                            @if($errors->has('type'))
                                <span class="help-block">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div id="type-other" style="display: none;">
                        <div class="form-group {{ $errors->has('type_other') ? 'has-error' : '' }}">
                            <label for="" class="col-md-2 control-label">ระบุเพิ่มเติม : </label>
                            <div class="col-md-8">
                                <input type="text" name="type_other" class="form-control" value="{{ old('type_other', $serviceFee->type_other) }}">
                                @if($errors->has('type_other'))
                                    <span class="help-block">{{ $errors->first('type_other') }}</span>
                                @endif
                            </div>
                        </div><br/>
                        <div class="form-group {{ $errors->has('type_other_amount') ? 'has-error' : '' }}">
                            <label for="" class="col-md-2 control-label">จำนวนเงิน : </label>
                            <div class="col-md-2">
                                <input type="number" name="type_other_amount" class="form-control" value="{{ old('type_other_amount', $serviceFee->type_other_amount) }}">
                                @if($errors->has('type_other_amount'))
                                    <span class="help-block">{{ $errors->first('type_other_amount') }}</span>
                                @endif
                            </div>
                        </div><br/>
                    </div>
                    <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">ชำระค่าบำรุงตั้งแต่วันที่ : </label>
                        <div class="col-md-9">
                            <input type="text" name="start_date" class="form-control datepicker" value="{{ old('start_date', $serviceFee->start_date->format('d-m-Y')) }}">
                            @if($errors->has('start_date'))
                                <span class="help-block">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">ถึงวันที่ : </label>
                        <div class="col-md-9">
                            <input type="text" name="end_date" class="form-control datepicker" value="{{ old('end_date', $serviceFee->end_date->format('d-m-Y')) }}">
                            @if($errors->has('end_date'))
                                <span class="help-block">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div><hr/>
                    <div class="form-group">
                        <label class="control-label col-md-2">ผู้ทำรายการ : </label>
                        <div class="col-md-5 {{ $errors->has('staff_firstname') ? 'has-error' : '' }}">
                            <input type="text" name="staff_firstname" class="form-control" placeholder="ชื่อ" value="{{ old('staff_firstname', $serviceFee->staff_firstname) }}">
                            @if($errors->has('staff_firstname'))
                                <span class="help-block">{{ $errors->first('staff_firstname') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4  {{ $errors->has('staff_lastname') ? 'has-error' : '' }}">
                            <input type="text" name="staff_lastname" class="form-control" placeholder="นามสกุล"  value="{{ old('staff_lastname', $serviceFee->staff_lastname) }}">
                            @if($errors->has('staff_lastname'))
                                <span class="help-block">{{ $errors->first('staff_lastname') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('geography_id') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">สาขา : </label>
                        <div class="col-md-9">
                            <select class="form-control" name="geography_id">
                                <option value="">-- เลือกสาขา --</option>
                                @foreach(App\Geography::all() as $geography)
                                    <option value="{{ $geography->id }}" @if(old('geography_id', $serviceFee->geography_id) == $geography->id) selected @endif>สาขา {{ $geography->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <span class="help-block">{{ $errors->first('geography_id') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group">
                        <div class="col-md-offset-2 colmd-8">
                            <a href="{{ url('tab_member/service_fee/' . $serviceFee->tab_member_no) }}" class="btn btn-warning">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-primary">บันทึก</button>
                            <button type="reset" class="btn btn-default">Clear</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var $type = $('input[name=type]')
        var $typeOther = $('#type-other')
        var oldType = '{{ old('type', $serviceFee->type) }}'

        changeType(oldType)

        $type.change(function(e) {
            changeType($(this).val())
        })

        function changeType(value) {
            if(value == 'อื่นๆ') {
                $typeOther.show()
            }else {
                $typeOther.hide()
            }
        }
    </script>
@endsection
