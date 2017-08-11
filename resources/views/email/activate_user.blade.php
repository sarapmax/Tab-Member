<!doctype html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div>
        กรุณากด <a href="{{ url('manage_user/activate', $user->id) }}">ที่นี้</a> เพื่อเปิดใช้งานสมาชิก {{ $user->email }}
    </div>
</body>
</html>
