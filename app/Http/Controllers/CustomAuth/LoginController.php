<?php

namespace App\Http\Controllers\CustomAuth;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomAuth\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;



class LoginController extends Controller
{
    //Hiện thị màn hình đăng nhập
    protected function getLogin(){
        return view('auth.login');
    }

    //Xử lý đăng nhập
    protected function postLogin(LoginRequest $request){
        $user = User::where('email',$request->email)->first();
        if($user){
            $user_confirm = $user->confirmed;

            if($user_confirm == 1){

                //Lấy dữ liệu từ form đăng nhập
                $credentials =
                [
                    'email'=>$request->email,
                    'password'=>$request->password,
                ];

                //Check có nhớ tài khoản hay không
                $remember = $request->has('remember')?true:false;
                if (Auth::attempt($credentials,$remember)) {

                        $request->session()->regenerate();

                        return redirect()->intended('/')->withSuccess('Bạn đã đăng nhập thành công!');
                }
                else {
                    session()->flash('error', "Tài khoản không tồn tại");
                    return redirect()->back();
                }
            }
            else{
                return redirect()->route('view.checkcode')->with('error','Bạn chưa kích hoạt tài khoản, vui lòng kiểm tra email và nhập vào mã kích hoạt tài khoản của mình');
            }
        }
        else {
            session()->flash('error', "Tài khoản không tồn tại");
            return redirect()->back();
        }
    }

}
