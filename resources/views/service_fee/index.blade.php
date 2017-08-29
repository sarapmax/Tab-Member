@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก &raquo; ค่าบำรุงสมาชิก &raquo; ' . $tab_member->firstname . ' ' . $tab_member->lastname)

@section('content')

    <div class="card">
        <div class="card-body">
            @if(count($service_fees) > 0)
                <div class="pull-right">
                    <a href="{{ url('tab_member/service_fee/' . $tab_member->no . '/create') }}" class="btn btn-primary">เพิ่มค่าบำรุงสมาชิก</a>
                </div>
                <div class="clearfix"></div>
                <table class="table-datatable table table-striped table-hover mv-lg">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อ-นามสกุล</th>
                        <th>ประเภทค่าบำรุงสมาชิก</th>
                        <th>ชำระตั้งแต่วันที่ - ถึงวันที่</th>
                        <th>ผู้ทำรายการ</th>
                        <th>วันที่ทำรายการ</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($service_fees as $i => $service_fee)
                        <tr>
                            <td>{{ $i+1 }}</td>
                            <td>
                                {{ $service_fee->firstname . ' ' . $service_fee->lastname }} <br/>
                            </td>
                            <td>
                                {{ $service_fee->type }}
                                @if($service_fee->type == 'อื่นๆ')
                                    <br/>
                                    {{ $service_fee->type_other }} {{ $service_fee->type_other_amount }} บาท
                                @endif
                            </td>
                            <td>{{ $service_fee->start_date->format('d-m-Y') . ' ถึง ' . $service_fee->end_date->format('d-m-Y') }}</td>
                            <td>
                                {{ $service_fee->staff_firstname . ' ' . $service_fee->staff_lastname  }}
                                <br/>
                                สาขา {{ $service_fee->geography->name }}
                            </td>
                            <td>
                                {{ $service_fee->created_at->format('d-m-Y') }}
                            </td>
                            <td>
                                <a href="{{ route('service_fee.edit', $service_fee->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-title="แก้ไข"><em class="ion-edit"></em></a>
                                <form action="{{ route('service_fee.destroy', $service_fee->id) }}" method="POST" style="display:inline" onsubmit="return confirm('ยืนยันการลบข้อมูล ?')">
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
                    <h5><i class="fa fa-exclamation"></i> ยังไม่มีประวัติค่าบำรุงสมาชิก</h5>
                    <a href="{{ url('tab_member/service_fee/' . $tab_member->no . '/create') }}" class="btn btn-primary">เพิ่มค่าบำรุงสมาชิก</a>
                </div>
            @endif
        </div>
    </div>

@endsection
