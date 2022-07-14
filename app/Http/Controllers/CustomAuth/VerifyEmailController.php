<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
class VerifyEmailController extends Controller
{
    //view yêu cầu được xác thực
    public function view_Xac_Thuc(){
        return view('Auth.VerificationEmail.viewVerify');
    }

    //Xử lý request và gửi mail
    public function send_Mail(Request $request)
    {
        $email = $request->email;
        $rules = [
            'email'=> ['required','email']
        ];
        $messages = [
            'required'=> ':attribute không thể bỏ trống, vui lòng nhập vào Email của bạn!',
            'email'=>'Định dạng Email không đúng, vui lòng nhập lại!',
        ];
        $attributes = [
            'email'=>'Địa chỉ Email',
        ];
        $validated = $request->validate($rules,$messages,$attributes);
        $user = User::where('email',$email)->first();
        Mail::to($user->email)->send(new VerificationEmail($user));
        return redirect()->route('view.checkcode')->with('success','Vui lòng nhập mã xác thực đã được gửi trong email của bạn để xác thực tài khoản!');

    }

    //view check Code xác thực
    public function view_Check_Code(){
        return view('Auth.VerificationEmail.ViewCheckCode');
    }

    //Xử lý request và login
    public function check_Code(Request $request)
    {
        $code = $request->code;
        $user = User::where('confirm_code', $code);
        $updated = 0;
        if ($user->count() > 0) {

            $updated = $user->update([
                'confirmed' => 1,
                'email_verified_at' => date('Y/m/d H:i:s'),
            ]);
            $notification_status = 'Chúc mừng bạn đã kích hoạt tài khoản thành công!';

        } else {
            $notification_status ='Mã xác nhận không chính xác';

        }
        if($updated)
        {
            return redirect()->route('getLogin')->with('success', $notification_status);
        }
        else
        {
            return redirect()->back()->with('error', 'Xác thực không thành công vui lòng kiểm tra lại!');
        }
    }
}
