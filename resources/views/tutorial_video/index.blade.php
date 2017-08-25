@extends('layout.user')

@section('header-title', 'จัดการวีดีโอสอนการใช้งาน')

@section('content')

    <div class="card">
        <div class="crad-body">
            <video controls style="padding: 30px;width:100%;">
                <source src="{{ url('video/' . $video->video) }}" type="video/mp4">
            </video>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form style="padding-top: 10px;" action="{{ route('video_tutorial.update', $video->id) }}" method="POST" role="form" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="_method" value="PATCH">
                {{ csrf_field() }}
                <div class="form-group {{ $errors->has('video') ? 'has-error' : '' }}">
                    <label class="control-label col-md-2">วีดีโอสอนใช้งาน : </label>
                    <div class="col-md-6">
                        <input type="file" name="video" class="form-control">
                        @if($errors->has('video'))
                            <span class="help-block">{{ $errors->first('video') }}</span>
                        @endif
                    </div>
                    <div class="col-md-offset-4">
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
