<?php

namespace App\Http\Requests\CustomAuth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email'=>['required','email'],
            'password'=>['required'],
        ];
    }


    /**
     * Thiết lập thông báo lỗi
     * @return array
     */
    public function messages()
    {
        return
        [
            'required'=> ':attribute không được bỏ trống',
            'email'=>':attribute định dạng không đúng',
        ];
    }

    /**
     * Chỉ định tên form lỗi
     * @return array
     */
    public function attributes()
    {
        return
        [
            'email'=> 'Địa chỉ Email',
            'password'=> 'Mật khẩu',
        ];
    }
}
