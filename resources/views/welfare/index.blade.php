@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก &raquo; สวัสดิการ &raquo; ' . $tab_member->firstname . ' ' . $tab_member->lastname)

@section('content')

<div class="card">
    <div class="card-body">
        @if(count($welfares) > 0)
        <div class="pull-right">
            <a href="{{ url('tab_member/welfare/' . $tab_member->no . '/create') }}" class="btn btn-primary">แบบฟอร์มเบิกจ่ายสวัสดิการ</a>
        </div>
        <div class="clearfix"></div>
        <table class="table-datatable table table-striped table-hover mv-lg">
            <thead>
                <tr>
                    <th>#</th>
                    <th>สถานะ</th>
                    <th>ประเภทการเบิก</th>
                    <th>ชื่อผู้ขอเบิก</th>
                    <th>จำนวนเงิน</th>
                    <th>ผู้ทำรายการ</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($welfares as $i => $welfare)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                        {{ $welfare->receive_welfare }} <br/>
                        @if($welfare->receive_welfare == 'รับสวัสดิการเรียบร้อยแล้ว')
                        ณ วันที่ {{ $welfare->receive_welfare_date ? $welfare->receive_welfare_date->format('d-m-Y') : '' }}
                        @endif
                    </td>
                    <td>{{ $welfare->type }}</td>
                    <td>{{ $welfare->withdraw_type == 'รับสวัสดิการแทน' ? $welfare->withdraw_firstname . ' ' . $welfare->withdraw_lastname : $welfare->tab_member->firstname . ' ' . $welfare->tab_member->lastname }}</td>
                    <td>{{ number_format($welfare->amount) }}</td>
                    <td>
                        {{ $welfare->staff_firstname . ' ' . $welfare->staff_lastname }} <br/>
                        สาขา {{ $welfare->geography->name }}
                    </td>
                    <td>
                        <a target="_blank" href="{{ url('tab_member/welfare/' . $welfare->id . '/print') }}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-title="ปริ๊น"><em class="ion-printer"></em></a>
                        <a target="_blank" href="{{ url('welfare_evidences/' . $welfare->evidence) }}" class="btn btn-success btn-sm" data-toggle="tooltip" data-title="ดาวโหลดเอกสาร"><em class="ion-document-text"></em></a>
                        <a href="{{ route('welfare.edit', $welfare->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-title="แก้ไข"><em class="ion-edit"></em></a>
                        <form action="{{ route('welfare.destroy', $welfare->id) }}" method="POST" style="display:inline" onsubmit="return confirm('ยืนยันการลบข้อมูล ?')">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" data-toggle="tooltip" data-title="ลบ" class="btn btn-danger btn-sm"><em class="ion-trash-b"></em></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <div class="text-center" style="margin: 20px 0">
                <h5><i class="fa fa-exclamation"></i> ยังไม่มีประวัติการเบิกสวัสดิการ</h5>
                <a href="{{ url('tab_member/welfare/' . $tab_member->no . '/create') }}" class="btn btn-primary">แบบฟอร์มเบิกจ่ายสวัสดิการ</a>
            </div>
        @endif
    </div>
</div>

@endsection
