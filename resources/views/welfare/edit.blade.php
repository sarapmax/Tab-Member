@extends('layout.user')

@section('header-title', 'แก้ไขแบบฟอร์มเบิกจ่ายสวัสดิการ')

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('welfare.update', $welfare->id) }}" method="POST" role="form" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="tab_member_no" value="{{ $welfare->tab_member_no }}">
                {{ csrf_field() }}
                <fieldset>
                    <legend>ส่วนที่ 1 ยื่นคำร้องขอเบิกสวัสดิการ</legend>
                    <div class="form-group {{ $errors->has('withdraw_type') ? 'has-error' : '' }}">
                        <label for="" class="col-md-2 control-label"></label>
                        <div class="col-md-8">
                            <label>
                                <input type="radio" value="รับสวัสดิการของตนเอง" name="withdraw_type" class="withdraw-type" @if(old('withdraw_type', $welfare->withdraw_type) == 'รับสวัสดิการของตนเอง') checked @endif> &nbsp;รับสวัสดิการของตนเอง&nbsp;&nbsp;
                            </label>
                            <label>
                                <input type="radio" value="รับสวัสดิการแทน" name="withdraw_type" class="withdraw-type" @if(old('withdraw_type', $welfare->withdraw_type) == 'รับสวัสดิการแทน') checked @endif> &nbsp;รับสวัสดิการแทน
                            </label>
                            @if($errors->has('withdraw_type'))
                                <span class="help-block">{{ $errors->first('withdraw_type') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div id="withdraw-name" style="display: none;margin-bottom: 20px" class="form-group">
                        <label class="control-label col-md-2">ชื่อ - นามสกุล : </label>
                        <div class="col-md-5 {{ $errors->has('withdraw_firstname') ? 'has-error' : '' }}">
                            <input type="text" name="withdraw_firstname" class="form-control" placeholder="ชื่อ" value="{{ old('withdraw_firstname', $welfare->withdraw_firstname) }}">
                            @if($errors->has('withdraw_firstname'))
                                <span class="help-block">{{ $errors->first('withdraw_firstname') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4  {{ $errors->has('withdraw_lastname') ? 'has-error' : '' }}">
                            <input type="text" name="withdraw_lastname" class="form-control" placeholder="นามสกุล"  value="{{ old('withdraw_lastname', $welfare->withdraw_lastname) }}">
                            @if($errors->has('withdraw_lastname'))
                                <span class="help-block">{{ $errors->first('withdraw_lastname') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">ประเภทการเบิกสวัสดิการ : </label>
                        <div class="col-md-9">
                            <select class="form-control" id="welfare-type" name="type">
                                <option value="">-- เลือกประเภทการเบิกสวัสดิการ --</option>
                                <option @if(old('type', $welfare->type) == 'เบิกค่ารักษาพยาบาล') selected @endif value="เบิกค่ารักษาพยาบาล">เบิกค่ารักษาพยาบาล</option>
                                <option @if(old('type', $welfare->type) == 'เบิกฌาปนกิจสงเคราะห์') selected @endif value="เบิกฌาปนกิจสงเคราะห์">เบิกฌาปนกิจสงเคราะห์</option>
                                <option @if(old('type', $welfare->type) == 'ช่วยเหลือกรณีฉุกเฉิน (เฉพาะหน้า)') selected @endif value="ช่วยเหลือกรณีฉุกเฉิน (เฉพาะหน้า)">ช่วยเหลือกรณีฉุกเฉิน (เฉพาะหน้า)</option>
                            </select>
                            @if($errors->has('type'))
                                <span class="help-block">{{ $errors->first('type') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('evidence_name') ? 'has-error' : '' }}">
                        <label for="" class="col-md-2 control-label"></label>
                        <div class="col-md-8">
                            <div style="display:none;margin-bottom: 20px;" id="medical-or-ermergency">
                                <label>
                                    <input type="radio" value="ใบเสร็จค่ารักษาพยาบาล" name="evidence_name" @if(old('evidence_name', $welfare->evidence_name) == 'ใบเสร็จค่ารักษาพยาบาล') checked @endif> &nbsp;&nbsp;ใบเสร็จค่ารักษาพยาบาล
                                </label><br/>
                                <label>
                                    <input type="radio" value="ใบรับรองแพทย์" name="evidence_name" @if(old('evidence_name', $welfare->evidence_name) == 'ใบรับรองแพทย์') checked @endif> &nbsp;&nbsp;ใบรับรองแพทย์
                                </label><br/>
                                <label>
                                    <input type="radio" value="สำเนาบัตรสมาชิกสมาคมฯ" name="evidence_name" @if(old('evidence_name', $welfare->evidence_name) == 'สำเนาบัตรสมาชิกสมาคมฯ') checked @endif> &nbsp;&nbsp;สำเนาบัตรสมาชิกสมาคมฯ
                                </label>
                            </div>
                            <div style="display:none;margin-bottom: 20px;" id="dead">
                                <label>
                                    <input type="radio" value="ใบมรณะบัตร" name="evidence_name" @if(old('evidence_name', $welfare->evidence_name) == 'ใบมรณะบัตร') checked @endif> &nbsp;&nbsp;ใบมรณะบัตร
                                </label><br/>
                                <label>
                                    <input type="radio" value="บัตรสมาชิกสมาคมฯ (ตัวจริง)" name="evidence_name" @if(old('evidence_name', $welfare->evidence_name) == 'บัตรสมาชิกสมาคมฯ (ตัวจริง)' ) checked @endif> &nbsp;&nbsp;บัตรสมาชิกสมาคมฯ (ตัวจริง)
                                </label>
                            </div>
                            @if($errors->has('evidence_name') && old('type'))
                                <span class="help-block">{{ $errors->first('evidence_name') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('evidence') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">อัพโหลดหลักฐาน : </label>
                        <div class="col-md-9">
                            <input type="file" name="evidence" class="form-control">
                            @if($welfare->evidence)
                                <br/>
                                <a target="_blank" href="{{ url('welfare_evidences/' . $welfare->evidence) }}">{{ $welfare->evidence_name . ' - ' .$welfare->evidence }}</a>
                            @endif
                            @if($errors->has('evidence'))
                                <span class="help-block">{{ $errors->first('evidence') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('amount') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">จำนวนเงิน : </label>
                        <div class="col-md-9">
                            <input type="text" name="amount" class="form-control" placeholder="จำนวนเงิน" value="{{ old('amount', $welfare->amount) }}">
                            @if($errors->has('amount'))
                                <span class="help-block">{{ $errors->first('amount') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('withdraw_phone_number') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">เบอร์โทรศัพท์ : </label>
                        <div class="col-md-9">
                            <input type="text" name="withdraw_phone_number" class="form-control" placeholder="เบอร์โทรศัพท์ที่สามารถติดต่อได้ " value="{{ old('withdraw_phone_number', $welfare->withdraw_phone_number) }}">
                            @if($errors->has('withdraw_phone_number'))
                                <span class="help-block">{{ $errors->first('withdraw_phone_number') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">บันทึก : </label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="comment" placeholder="รายละเอียดเพิ่มเติม">{{ old('comment', $welfare->comment) }}</textarea>
                            @if($errors->has('comment'))
                                <span class="help-block">{{ $errors->first('comment') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('withdraw_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">วันที่ขอเบิก : </label>
                        <div class="col-md-9">
                            <input type="text" name="withdraw_date" class="form-control datepicker" value="{{ old('withdraw_date', $welfare->withdraw_date->format('d-m-Y')) }}">
                            @if($errors->has('withdraw_date'))
                                <span class="help-block">{{ $errors->first('withdraw_date') }}</span>
                            @endif
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>ส่วนที่ 2 รับเงินสวัสดิการ</legend>
                    <div class="form-group">
                        <label class="control-label col-md-2">ผู้จ่ายเงิน</label>
                        <div class="col-md-5 {{ $errors->has('staff_firstname') ? 'has-error' : '' }}">
                            <input type="text" name="staff_firstname" class="form-control" placeholder="ชื่อ" value="{{ old('staff_firstname', $welfare->staff_firstname) }}">
                            @if($errors->has('staff_firstname'))
                                <span class="help-block">{{ $errors->first('staff_firstname') }}</span>
                            @endif
                        </div>
                        <div class="col-md-4  {{ $errors->has('staff_lastname') ? 'has-error' : '' }}">
                            <input type="text" name="staff_lastname" class="form-control" placeholder="นามสกุล"  value="{{ old('staff_lastname', $welfare->staff_lastname) }}">
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
                                    <option value="{{ $geography->id }}" @if(old('geography_id', $welfare->geography_id) == $geography->id) selected @endif>สาขา {{ $geography->name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('type'))
                                <span class="help-block">{{ $errors->first('geography_id') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('receive_welfare') ? 'has-error' : '' }}">
                        <label for="" class="col-md-2 control-label"></label>
                        <div class="col-md-8">
                            <label>
                                <input type="radio" value="รับสวัสดิการเรียบร้อยแล้ว" name="receive_welfare" class="withdraw-type" @if(old('receive_welfare', $welfare->receive_welfare) == 'รับสวัสดิการเรียบร้อยแล้ว') checked @endif> &nbsp;รับสวัสดิการเรียบร้อยแล้ว&nbsp;&nbsp;
                            </label>
                            <label>
                                <input type="radio" value="ยังไม่ได้รับสวัสดิการ" name="receive_welfare" class="withdraw-type" @if(old('receive_welfare', $welfare->receive_welfare) == 'ยังไม่ได้รับสวัสดิการ') checked @endif> &nbsp;ยังไม่ได้รับสวัสดิการ
                            </label>
                            @if($errors->has('receive_welfare'))
                                <span class="help-block">{{ $errors->first('receive_welfare') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group {{ $errors->has('receive_welfare_date') ? 'has-error' : '' }}">
                        <label class="control-label col-md-2">วันที่รับเงิน : </label>
                        <div class="col-md-9">
                            <input type="text" name="receive_welfare_date" class="form-control datepicker" value="{{ old('receive_welfare_date', $welfare->receive_welfare_date ? $welfare->receive_welfare_date->format('d-m-Y') : '') }}">
                            @if($errors->has('receive_welfare_date'))
                                <span class="help-block">{{ $errors->first('receive_welfare_date') }}</span>
                            @endif
                        </div>
                    </div><br/>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-9">
                            <a href="{{ url('tab_member/welfare/'. $welfare->tab_member_no) }}" class="btn btn-warning">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                            <input type="reset" class="btn btn-default" value="Clear">
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        var $welfareType = $('#welfare-type')
        var $withdrawType = $('.withdraw-type')
        var oldWelfareType = '{{ old('type', $welfare->type) }}'
        var $dead = $('#dead')
        var $medicalOrEmergency = $('#medical-or-ermergency')
        var oldWithdrawType = '{{ old('withdraw_type', $welfare->withdraw_type) }}'

        changeWelfareType(oldWelfareType)
        changeWithdrawType(oldWithdrawType)

        $welfareType.change(function(e) {
            changeWelfareType($(this).val())
        })

        function changeWelfareType(value) {
            if(value == '') {
                $medicalOrEmergency.hide()
                $dead.hide()

                $dead.find('input').prop('checked', false)
                $medicalOrEmergency.find('input').prop('checked', false)
            }

            if(value == 'เบิกค่ารักษาพยาบาล' || $welfareType.val() == 'ช่วยเหลือกรณีฉุกเฉิน (เฉพาะหน้า)') {
                $medicalOrEmergency.show()
                $dead.hide()

                $dead.find('input').prop('checked', false)
            }

            if(value == 'เบิกฌาปนกิจสงเคราะห์') {
                $dead.show()
                $medicalOrEmergency.hide()

                $medicalOrEmergency.find('input').prop('checked', false)
            }
        }

        $withdrawType.click(function(e) {
            changeWithdrawType($(this).val())
        })

        function changeWithdrawType(value) {
            if(value == 'รับสวัสดิการแทน') {
                $('#withdraw-name').show()
            }else {
                $('#withdraw-name').hide()
            }
        }
    </script>
@endsection
