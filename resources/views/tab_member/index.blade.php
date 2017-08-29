@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก')

@section('content')

<div class="card">
    <div class="card-body">
    	<form action="{{ route('tab_member.index') }}" method="GET" role="form">
    		<fieldset>
    			<legend><em class="ion-search"></em> ค้นหาสมาชิก</legend>

                <div class="form-group">
                    <div class="col-lg-2">
                        <label style="font-size: 12px;" for="no">รหัสสมาชิก	</label>
                        <input type="text" class="form-control" id="no" name="no" value="{{ $filters['no'] }}">
                    </div>
                    <div class="col-lg-3">
                        <label style="font-size: 12px;" for="name">ชื่อ-นามสกุล</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $filters['name'] }}">
                    </div>
                    <div class="col-lg-2">
                        <label style="font-size: 12px;" for="phone_number">เบอร์โทรศัพท์</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $filters['phone_number'] }}">
                    </div>
                    <div class="col-lg-2">
                        <label style="font-size: 12px;" for="idcard">หมายเลขบัตรประชาชน</label>
                        <input type="text" class="form-control" id="idcard" name="idcard" value="{{ $filters['idcard'] }}">
                    </div>
                    <div class="col-lg-1">
                        <button style="margin-top:25px;" type="submit" class="btn btn-primary"><i class="ion-android-search"></i> ค้นหา</button>
                    </div>
                    <div class="col-lg-1">
                        <a style="margin-top:25px;"  href="{{ url('tab_member')  }}" class="btn btn-default">Clear</a>
                    </div>
                </div>
            </fieldset>
    	</form>
        @if(count($tab_members) > 0)
    	<table class="table table-striped table-hover mv-lg">
    		<thead>
    			<tr>
                    <th>ลำดับ</th>
                    <th>รหัสสมาชิก</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>โทรศัพท์มือถือ</th>
                    <th class="text-center" colspan="2">ข้อมูลสิทธิ์</th>
    			</tr>
    		</thead>
            <tbody>
                @foreach($tab_members as $i => $tab_member)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $tab_member->no }}</td>
                    <td>{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname . ' ' . $tab_member->lastname }}</td>
                    <td>{{ $tab_member->mobile_number }}</td>
                    <td style="width: 380px;">
                        <a target="_blank" href="{{ route('tab_member.show', $tab_member->no) }}" class="btn btn-default btn-xs"><em class="ion-person"></em> รายละเอียด</a>
                        <a target="_blank" href="{{ url('tab_member/card/'.$tab_member->no) }}" class="btn btn-primary btn-xs"><em class="ion-card"></em> บัตรสมาชิก</a>
                        <a target="_blank" href="{{ route('welfare.show', $tab_member->no) }}" class="btn btn-success btn-xs"><em class="ion-briefcase"></em> สวัสดิการ</a>
                        <a target="_blank" href="{{ url('tab_member/service_fee/' . $tab_member->no) }}" class="btn btn-warning btn-xs">ค่าบำรุงสมาชิก</a>
                    </td>
                    <td style="width: 50px;">
                        <form action="{{ route('tab_member.destroy', $tab_member->no) }}" method="POST" style="display:inline" onsubmit="return confirm('ยืนยันการลบข้อมูล ?')">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" data-toggle="tooltip" data-title="ลบ" class="btn btn-danger btn-xs"><em class="ion-trash-b"></em> </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
    	</table>
        <hr>
        <div class="pull-right">
            {{ $tab_members->appends($filters)->links() }}
        </div>
        <div class="clearfix"></div>
        @else
        <div style="margin-left: 20px;">
            <hr>
            <p><i class="fa fa-exclamation"></i> ไม่พบผลการค้นหา</p>
        </div>
        @endif
    </div>
</div>

@endsection
