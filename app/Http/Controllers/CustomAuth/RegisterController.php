<?php

namespace App\Http\Controllers\CustomAuth;

use App\Models\User;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use App\Http\Requests\CustomAuth\RegisterRequest;

use Carbon\Carbon;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Mail;



class RegisterController extends Controller
{
    /**
     * Hiển thị form đăng ký
     */
    public function getRegister(){
        return view('auth.register');
    }

    //Xử lý đăng ký
    protected function postRegister(RegisterRequest $request)
    {
        $data = $request->all();

        //xử lý file Upload image user
        //Lấy thông tin file upload
        $file = $request->file('image');

        //Tạo tên file image upload
        $fileName = date('H-i-d-m-Y').'-'.$data['username'].'-'.$file->getClientOriginalName();

        //Lưu trữ file upload vào Storage
        $storedPath = $file->storeAs('public/image',$fileName);
        //Thay đổi tên lưu trữ lên DB
        $data['image'] = $storedPath;


        //Sửa định dạng birthdate
        $birthdate = Carbon::parse($data['birthdate'])->format('d/m/Y');
        $data['birthdate'] = $birthdate;
        /***
         * Lưu người dùng mới lên database
        */
        $user = new User();
        $user->username = $data['username'];
        $user->fullname = $data['fullname'];
        $user->gender = $data['gender'];
        $user->email =  $data['email'];
        $user->birthdate = $data['birthdate'];
        $user->password = Hash::make($data['password']);
        $user->image = $data['image'] ;
        $user->confirm_code = null;
        $user->confirmed = 0;
        $user->role = 'Guest';
        $user->remember_token = $data['_token'];
        $saved = $user->save();
        if($saved){
                $user->confirm_code = time().'-'.$user->user_id.'-'.uniqid(true);
                $user->update();
                Mail::to($user->email)->send(new VerificationEmail($user));
                return redirect()->route('view.checkcode')->with('success','Vui lòng nhập mã xác thực đã được gửi trong email của bạn để xác thực tài khoản!');
        }
        session()->flash('error', "Tạo tài khoản mới không thành công!");
        return redirect()->back();
    }

}

