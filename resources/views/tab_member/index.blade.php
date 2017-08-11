@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก')

@section('content')

<div class="card">
    <div class="card-body">
    	<form action="{{ route('tab_member.index') }}" method="GET" role="form">
    		<fieldset>
    			<legend><em class="ion-search"></em> ค้นหาสมาชิก</legend>
    		
    		<div class="form-group">
				<div class="input-group">
	              	<input type="text" class="form-control input-lg" name="value" placeholder="ค้นหาข้อมูลสมาชิกด้วย หมายเลขสมาชิก, ชื่อ, เบอร์โทรศัพท์มือถือ, หมายเลขบัตรประชาชน"><span class="input-group-btn">
	                <button style="height: 46px;" type="submit" class="btn btn-primary btn-lg"><em class="ion-android-search"></em></button></span>
	            </div>
            </div>
            </fieldset>
    	</form>

        @if($tab_members)
    	<table id="datatable1" class="table-datatable table table-striped table-hover mv-lg">
    		<thead>
    			<tr>
    				<th>#</th>
                    <th>หมายเลขสมาชิก</th>
    				<th>ชื่อ</th>
    				<th>หมายเลขบัตรประชาชน</th>
    				<th>เบอร์โทรศัพท์มือถือ</th>
    				<th></th>
                    <th></th>
    			</tr>
    		</thead>
            <tbody>
                @foreach($tab_members as $i => $tab_member)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $tab_member->no }}</td>
                    <td>{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname . ' ' . $tab_member->lastname }}</td>
                    <td>{{ $tab_member->idcard }}</td>
                    <td>{{ $tab_member->phone_number }}</td>
                    <td style="width: 220px;">
                        <a target="_blank" href="{{ route('tab_member.show', $tab_member->no) }}" class="btn btn-default btn-xs"><em class="ion-person"></em> ข้อมูล</a>
                        <a target="_blank" href="{{ url('tab_member/card/'.$tab_member->no) }}" class="btn btn-primary btn-xs"><em class="ion-card"></em> บัตรสมาชิก</a>
                        <a target="_blank" href="{{ route('welfare.show', $tab_member->no) }}" class="btn btn-success btn-xs"><em class="ion-briefcase"></em> สวัสดิการ</a>
                    </td>
                    <td style="width: 80px;">
                        <a target="_blank" href="{{ route('tab_member.edit', $tab_member->no) }}" data-toggle="tooltip" data-title="แก้ไข" class="btn btn-warning btn-xs"><em class="ion-edit"></em></a>
                        <form action="{{ route('tab_member.destroy', $tab_member->no) }}" method="POST" style="display:inline" onsubmit="return confirm('คุณแน่ใจใช่ไหม ?')">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" data-toggle="tooltip" data-title="ลบ" class="btn btn-danger btn-xs"><em class="ion-trash-b"></em></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
    	</table>
        @endif
    </div>
</div>

@endsection