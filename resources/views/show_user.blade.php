@extends('layout.user')

@section('header-title', 'ข้อมูลผู้ใช้')

@section('content')

<div class="card">
    <div class="card-body">

        {{-- <ul id="myTabs" role="tablist" class="nav nav-tabs nav-justified">
            <li role="presentation" class="active"><a id="member-detail-tab" href="#member_detail" role="tab" data-toggle="tab" aria-controls="member_detail" aria-expanded="true">ข้อมูลสมาชิก</a></li>
            <li role="presentation"><a id="welfare-detail-tab" href="#welfare_detail" role="tab" data-toggle="tab" aria-controls="welfare_detail">ข้อมูลการเบิกสวัสดิการ</a></li>
        </ul> --}}
            {{-- <div id="myTabContent" class="tab-content"> --}}
                {{-- <div id="member_detail" role="tabpanel" aria-labelledby="member-detail-tab" class="tab-pane fade in active"> --}}
        <h5>ข้อมูลส่วนตัว</h5>
        <table class="table table-striped">
            <tr>
                <td>อีเมล์</td>
                <td>{{ auth()->guard('user')->user()->email }}</td>
            </tr>
            <tr>
                <td>ชื่อ</td>
                <td>{{ auth()->guard('user')->user()->firstname }} {{ auth()->guard('user')->user()->lastname }}</td>
            </tr>
            <tr>
                <td>เบอร์โทรศัพท์มือถือ</td>
                <td>{{ auth()->guard('user')->user()->phone_number }}</td>
            </tr>
            <tr>
                <td>สาขา</td>
                <td>{{ auth()->guard('user')->user()->branch }}</td>
            </tr>
            <tr>
                <td>สถานะ</td>
                <td>{{ auth()->guard('user')->user()->admin ? 'Admin' : 'User' }}</td>
            </tr>
            <tr>
                <td>วันที่สมัคร</td>
                <td>{{ auth()->guard('user')->user()->created_at->format('d/m/Y') }}</td>
            </tr>
            <tr>
                <td>
                    <a href="{{ url('update_user') }}" class="btn btn-primary">แก้ไขข้อมูลส่วนตัว</a>
                </td>
                <td></td>
            </tr>
        </table>
    </div>
</div>

@endsection