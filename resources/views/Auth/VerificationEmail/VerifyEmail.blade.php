<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Xác thực tài khoản</h2>

        <div>
            <h5>Chúc mừng bạn đã đăng ký thành công!</h5><br>
            <h4>Xin chào {{$user->fullname}} !</h4>
            <p>Đây là mã xác thực của bạn!</p><br>
            <strong>Code:</strong>{{$user->confirm_code}}<br><br>
            <p>Vui lòng nhập vào đường link dưới đây để hoàn thành bước kích hoạt tài khoản của bạn</p><br>
            <hr>
            {{ URL::to('verify-email/active') }}.<br/>

        </div>

    </body>
</html>
