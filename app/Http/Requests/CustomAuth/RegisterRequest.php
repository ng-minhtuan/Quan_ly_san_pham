<?php

namespace App\Http\Requests\CustomAuth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'=> ['required','min:8','regex:/[a-zA-Z0-9]+/','unique:App\Models\User,username'],
            'fullname'=>['required','string'],
            'gender'=>['required'],
            'birthdate'=>['required','date_format:Y-m-d','date'],
            'email'=>['required','email','unique:App\Models\User,email'],
            'password'=>['required','regex:/[a-z]/','regex:/[A-Z]/', 'regex:/[0-9]/','regex:/[@$!%*#?&]/','min:8'],
            'password_confirmation'=>['required','same:password','min:8'],
            'image'=>['required','mimes:jpeg,jpg,png,gif','max:20000'],
        ];
    }

    public function messages()
    {
        return
        [
            'regex'=>':attribute định dạng không đúng',
            'required'=>":attribute không được bỏ trống",
            'min'=>':attribute phải có ít nhất :min ký tự',
            'string'=> ":attribute phải là ký tự chữ cái",
            'unique'=>":attribute đã tồn tại trong dữ liệu",
            'same'=>':attribute không giống với Mật khẩu',
            'mimes'=>':attribute định dạng file không đúng',
            'email'=>':attribute định dạng không đúng',
            'max'=> ':attribute file có dung lượng phải nhỏ 20000kb',
            'date_format'=> ":attribute định dạng thời gian không đúng",
        ];
    }

    public function attributes()
    {
        return
        [
            'username'=>"Tên đăng nhập",
            'fullname'=>"Họ và tên",
            'gender'=>"Giới tính",
            'birthdate'=>"Ngày sinh",
            'email'=>"Email",
            'password'=>"Mật khẩu",
            'password_confirmation'=>"Xác nhận mật khẩu",
            'image'=> "Ảnh đại diện",
        ];
    }
}
