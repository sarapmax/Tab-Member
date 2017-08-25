@extends('layout.user')

@section('header-title', 'จัดการผู้ใช้')

@section('content')

<div class="card">
    <div class="card-heading">
        <div class="pull-right">
            <a href="{{ url('manage_user/create') }}" class="btn btn-primary"><i class="fa fa-plus"> </i> เพิ่มผู้ใช้</a>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        	<table class="table datatable">
        		<thead>
        			<tr>
        				<th>ลำดับ</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>อีเมล</th>
        				<th>โทรศัพท์มือถือ</th>
        				<th>สาขา</th>
                        <th>สิทธิ์</th>
                        <th>แก้ไข</th>
                        <th>สถานะ</th>
                        <th>ลบ</th>
        			</tr>
        		</thead>
                <tbody>
                    @foreach($users as $i => $user)
                    <tr>
                        <td>{{ $i+1 }}</td>
                        <td>{{ $user->firstname . ' ' . $user->lastname }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_number }}</td>
                        <td>{{ $user->geography->name }}</td>
                        <td>
                            @if($user->admin)
                                <label class="label label-primary"><em class="ion-person"> </em> ผู้ดูแลระบบ</label>
                            @else
                                <label class="label label-success"><em class="ion-person"> </em> ผู้ใช้งาน</label>
                            @endif
                        </td>
                        <td><a href="{{ url('manage_user/edit/'.$user->id) }}" data-toggle="tooltip" data-title="แก้ไข" class="btn btn-warning btn-xs"><em class="ion-edit"></em></a></td>
                        <td>
                            @if(!$user->admin)
                            <a href="{{ url('manage_user/activate/'.$user->id) }}" class="btn btn-{{ $user->active ? 'success' : 'danger' }} btn-sm">{{ $user->active ? 'เปิดใช้งาน' : 'ปิดใช้งาน' }}</a>
                            @endif
                        </td>
                        <td>
                            <a onclick="return confirm('ยืนยันการลบข้อมูล?')" href="{{ url('manage_user/delete/'.$user->id) }}" class="btn btn-xs btn-danger"><em class="ion-trash-b"></em></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
        	</table>
        </div>
    </div>
</div>

@endsection
