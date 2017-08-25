@extends('layout.user')

@section('header-title', 'หน้าแรก')

@section('content')

<div class="card">
    <div class="card-body">
        <fieldset>
            <legend>วีดีโอนสอนใช้งานระบบ</legend>
            <video controls style="width:100%;">
                <source src="{{ url('video/' . $video->video) }}" type="video/mp4">
            </video>
        </fieldset>
    </div>
</div>

@endsection
