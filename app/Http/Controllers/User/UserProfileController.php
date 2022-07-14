<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;

use App\Models\TinTuc;

use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{


    //Khai báo Gate phân quyền
    public function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }
    //Xem thông tin cá nhân
    public function getProfile(User $user){
        return view('User/UserProfile',compact($user));
    }

    //Get trang sửa thông tin cá nhân
    public function getEdit(User $user){
        return view('User/UserEdit',compact($user));
    }

    //Xử lý Update
    public function updateProfile(Request $request, User $user){

        $rules = [
            'username'=> [ 'nullable','min:8','regex:/[a-zA-Z0-9]+/','unique:App\Models\User,username'],
            'fullname'=>['nullable','string'],
            'birthdate'=>['nullable','date_format:Y-m-d','date'],
            'email'=>['nullable','email','unique:App\Models\User,email'],
            'image'=>['nullable','mimes:jpeg,jpg,png,gif','max:20000'],
        ];

        $messages = [
            'regex'=>':attribute định dạng không đúng',
            'min'=>':attribute phải có ít nhất :min ký tự',
            'string'=> ":attribute phải là ký tự chữ cái",
            'unique'=>":attribute đã tồn tại",
            'date_format'=> ":attribute định dạng thời gian không đúng",
            'email'=>":attribute định dạng không đúng",
            'mimes'=>':attribute định dạng không đúng!',
        ];

        $attributes = [
            'username'=> 'Tên đăng nhập',
            'fullname'=> 'Họ tên',
            'birthdate'=> 'Ngày sinh',
            'email'=> 'Địa chỉ Email',
            'image'=>'Ảnh đại diện'
        ];
        $data = $request->except('_token');
        if(!empty($data['birthdate'])){
            $birthdate = Carbon::parse($data['birthdate'])->format('d/m/Y');
            $data['birthdate'] = $birthdate;
        }
        if(!empty($request->image)){
            $imgRequest = $request->image;
            $imgName = date('H-i-s-d-m-Y').'-'.auth()->user()->username.'-'.$imgRequest->getClientOriginalName();
            Storage::delete(auth()->user()->image);
            $imgUploaded = $imgRequest->storeAs('/public/image',$imgName);
            $data['image'] = $imgUploaded;
        }
        foreach($data as $key => $value)
        {
            if(!empty($value))
            {
                $validated = $request->validate($rules,$messages,$attributes);
                User::select($key)->where($key, auth()->user()->$key)->update([$key=>$value]);
            }
        }

        return redirect()->route('user.profile')->with('success','Bạn đã cập nhật thành công !!');
    }

    /**
     * Xoá tài khoản
     */
    public function deleteUser(User $user){
        $dataUser = $user::find(auth()->user()->user_id);
        $deleted = $dataUser->delete();
        if($dataUser->trashed())
        {
            return redirect()->route('home')->with('success','Bạn đã xoá tài khoản thành công!');
        }
        else {
            return redirect()->back()->with('error','Không thể xoá tài khoản cá nhân');
        }
    }

    /**
     * View đổi ảnh đại diện
     */
    public function viewUpdateImage(){
        return view('User.UserImageUpload');
    }

    /**
     * Xử lý đổi ảnh
     */
    public function updateImage(Request $request){
        $validated = $request->validate(
            ['image'=>'required','mimes:jpeg,jpg,png,gif','max:20000'],
            [
                'required'=>':attribute không được bỏ trống',
                'mimes'=>':attribute không đúng định dạng',
                'max'=>':attribute vượt quá giới hạn cho phép'
            ],
            ['image'=>'Ảnh đại diện muốn đổi']
        );
        if(!empty($request->image)){
            $imgRequest = $request->image;
            $imgName = date('H-i-s-d-m-Y').'-'.auth()->user()->username.'-'.$imgRequest->getClientOriginalName();
            Storage::delete(auth()->user()->image);
            $imgUploaded = $imgRequest->storeAs('/public/image',$imgName);
            auth()->user()->image = $imgUploaded;
            $updated = auth()->user()->update();
            if($updated){
                return redirect()->route('user.profile')->with('success','Bạn đã cập nhật thành công !!');
            }
            else
            {
                return redirect()->back()->with('error', 'Cập nhật thất bại hãy thử lại!');
            }
        }

    }

}
