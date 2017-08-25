@extends('layout.user')

@section('header-title', 'ข้อมูลสมาชิก &raquo; บัตรสมาชิก &raquo; ' . $tab_member->firstname . ' ' . $tab_member->lastname)

@section('content')

<div class="card">
    <div class="card-body">

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title"><em class="ion-card"></em> บัตรสมาชิก</div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3">
                        @if($tab_member->profile_img)
                        <div class="thumbnail">
                            <img src="{{ asset('uploads/profile_images/' . $tab_member->profile_img) }}">
                        </div>
                        @endif
                        <form action="{{ url('tab_member/upload_profile_img') }}" method="POST" role="form" enctype="multipart/form-data"> 
                            {{ csrf_field() }}
                            <input type="hidden" name="tab_member_no" value="{{ $tab_member->no }}">
                            <label class="btn btn-primary btn-sm">
                                <em class="ion-archive"> </em> อัพโหลดรูปภาพ <input type="file" style="display: none;" name="profile_img" onchange="javascript:this.form.submit();">
                            </label>
                            <button type="button" onClick="modalTakePhoto()" class="btn btn-warning btn-sm"><em class="ion-camera"></em> ถ่ายรูป</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-4"><p><b>ประเภทสมาชิก : </b></p></div>
                        <div class="col-md-6"><p>{{ $tab_member->period_type }}</p></div>
                        <div class="col-md-4"><p><b>หมายเลขสมาชิก : </b></p></div>
                        <div class="col-md-6"><p>{{ $tab_member->no }}</p></div>
                        <div class="col-md-4"><p><b>ชื่อ - นามสกุล : </b></p></div>
                        <div class="col-md-6"><p>{{ !empty($tab_member->name_prefix->name) ? $tab_member->name_prefix->name : '' }} {{ $tab_member->firstname . ' ' . $tab_member->lastname }}</p></div>
                        <div class="col-md-4"><p><b>หมายเลขบัตรประชาชน : </b></p></div>
                        <div class="col-md-6"><p>{{ $tab_member->idcard }}</p></div>
                    </div>
                </div>
                <hr>
                <h5>ที่อยู่ตามบัตรประชาชน</h5>
                <table class="table-detail">
                    <tr>
                        <th style="width:15%;">บ้านเลขที่</th>
                        <td style="width:20%;">{{ $tab_member->home_number }}</td>
                        <th style="width:15%;">หมู่</th>
                        <td>{{ $tab_member->moo }}</td>
                    </tr>
                    <tr>
                        <th>หมู่บ้าน/อาคาร/ชั้น/ตึก</th>
                        <td>{{ $tab_member->village }}</td>
                        <th>ซอย/ตรอก</th>
                        <td>{{ $tab_member->soi }}</td>
                    </tr>
                    <tr>
                        <th>ถนน</th>
                        <td>{{ $tab_member->road }}</td>
                        <th>ตำบล/แขวง</th>
                        <td>{{ $tab_member->sub_district->name }}</td>
                    </tr>
                    <tr>
                        <th>อำเภอ/เขต</th>
                        <td>{{ $tab_member->sub_district->district->name }}</td>
                        <th>จังหวัด</th>
                        <td>{{ $tab_member->sub_district->district->province->name }}</td>
                    </tr>
                    <tr>
                        <th>รหัสไปรษณีย์</th>
                        <td>{{ $tab_member->sub_district->zipcode->zipcode }}</td>
                    </tr>
                    <tr>
                        <th>สถานะ</th>
                        <td>{{ $tab_member->dead ? 'เสียชีวิต' : 'มีชีวิต' }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div id="myModal" class="modal fade">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">ถ่ายรูปบัตรสมาชิก</h5>
                    </div>
                <div class="modal-body">
                    <center>
                        <div class="thumbnail">
                            <div id="my_camera" style="width:330px; height:240px;"></div>
                        </div>
                        <div class="thumbnail">
                            <div style="width:330px; height:240px;" id="my_result"></div>
                        </div>
                    </center>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-warning" href="javascript:void(take_snapshot())"><em class="ion-camera"></em>  ถ่ายรูป</a>
                    <button type="button" onClick="uploadPhotoToServer()" class="btn btn-primary"><em class="ion-archive"> </em> อัพโหลดภาพ</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection

@section('js')

  <script>
    function modalTakePhoto() {
        Webcam.set({
            width: 320,
            height: 240,
            image_format: 'jpeg',
            jpeg_quality: 200,
            enable_flash: false
        });

        Webcam.attach( '#my_camera' );

        $('#myModal').modal('show')
    }

    var shutter = new Audio();
    shutter.autoplay = false;
    shutter.src = navigator.userAgent.match(/Firefox/) ? '{{ asset('webcamjs/demos/shutter.ogg') }}' : '{{ asset('webcamjs/demos/shutter.mp3') }}';

    function take_snapshot() {
        shutter.play();
        // take snapshot and get image data
        Webcam.snap( function(data_uri) {
            // display results in page
            document.getElementById('my_result').innerHTML = 
                '<img id="photo" src="'+data_uri+'"/>';
        } );
    }

    function uploadPhotoToServer() {
        var url = '{{ url('tab_member/upload_profile_img') }}';
        var image = $('#photo').attr('src');
        // Split the base64 string in data and contentType
        var block = image.split(";");
        // Get the content type
        var contentType = block[0].split(":")[1];// In this case "image/gif"
        // get the real base64 content of the file
        var realData = block[1].split(",")[1];// In this case "iVBORw0KGg...."

        // Convert to blob
        var blob = b64toBlob(realData, contentType);

        // Create a FormData and append the file
        var fd = new FormData();
        fd.append("profile_img", blob);
        fd.append("tab_member_no", '{{ $tab_member->no }}');

        $.ajax({
            url: url, 
            type: "POST", 
            cache: false,
            contentType: false,
            processData: false,
            data: fd
        }).done(function(e){
            location.reload();
        });
    }

    function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

      var blob = new Blob(byteArrays, {type: contentType});
      return blob;
    }
    </script>

@endsection
