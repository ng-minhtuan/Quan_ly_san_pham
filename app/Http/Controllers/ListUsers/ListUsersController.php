<?php

namespace App\Http\Controllers\ListUsers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;

use App\Models\User;

use Carbon\Carbon;

use Illuminate\Support\Facades\Storage;


class ListUsersController extends Controller
{

     //Khai báo Gate phân quyền
    public function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }


    /***
     * Truy cập trang danh sách người dùng
     */
    public function getList(){
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền thực hiện thao tác này!'));
        }
        $data = User::latest()->paginate(10);
        return view('User/ListUsers/ListUsers',compact('data'));
    }

    /***
     * Xem trang cá nhân của người dùng
     */
    public function getUser($id){
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền thực hiện thao tác này!'));
        }
        $user = User::find($id);
        return view('User/ListUsers/GetUser',compact('user'));
    }

    /**
     * Hiển thị trang sửa thông tin cá nhân người dùng
     */
    public function editUser($id){
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền thực hiện thao tác này!'));
        }
        $user = User::find($id);
        return view('User/ListUsers/ListEditUser', compact('user'));
    }

    /**
     * Xử lý update thông tin cá nhân người dùng
     */

    public function updateUser(Request $request,$id){
        $user = User::find($id);

        $rules = [
            'username'=> [ 'nullable','min:8','regex:/[a-zA-Z0-9]+/','unique:App\Models\User,username'],
            'fullname'=>['nullable','string'],
            'birthdate'=>['nullable','date_format:Y-m-d','date'],
            'email'=>['nullable','email','unique:App\Models\User,email'],
        ];

        $messages = [
            'regex'=>':attribute định dạng không đúng',
            'min'=>':attribute phải có ít nhất :min ký tự',
            'string'=> ":attribute phải là ký tự chữ cái",
            'unique'=>":attribute đã tồn tại",
            'date_format'=> ":attribute định dạng thời gian không đúng",
            'email'=>":attribute định dạng không đúng",
        ];

        $attributes = [
            'username'=> 'Tên đăng nhập',
            'fullname'=> 'Họ tên',
            'birthdate'=> 'Ngày sinh',
            'email'=> 'Địa chỉ Email',
        ];
        $data = $request->except('_token');
        // dd($data);
        if(!empty($data['birthdate'])){
            $birthdate = Carbon::parse($data['birthdate'])->format('d/m/Y');
            $data['birthdate'] = $birthdate;
        }
        if(!empty($request->image)){
            $imgRequest = $request->image;
            $imgName = date('H-i-s-d-m-Y').'-'.$request->username.'-'.$imgRequest->getClientOriginalName();
            $del = Storage::delete($user->image);
            $imgUploaded = $imgRequest->storeAs('/public/image',$imgName);
            $data['image'] = $imgUploaded;
        }
        foreach($data as $key => $value)
        {
            $userMail = $user->email;
            $userName = $user->username;
            if(!empty($value))
            {
                    $validated = $request->validate($rules,$messages,$attributes);
                    $user->select($key)->where($key,$user->$key)->update([$key=>$value]);

            }
        }
        return redirect()->route('list.getUser',['id'=>$user->user_id])->with('success','Bạn đã cập nhật thành công !!');
    }

    /**
     * Xoá tài khoản người dùng
     */

    public function deleteUser($id){
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền thực hiện thao tác này!'));
        }
        $dataUser = User::find($id);
        $deleted = $dataUser->delete();
        if($deleted){
            return redirect()->route('list.get')->with('success','Bạn đã xoá tài khoản thành công!');
        }
        else {
            return redirect()->back()->with('error','Bạn không thể xoá tài khoản cá nhân');
        }
    }

    /**
     * Xem danh sách bài viết đã đăng
     */
    public function showListTinTuc($id){
        if(!$this->userCan('is-guest') && auth()->user()->user_id != $id)
        {
            abort('403',__('Bạn không có quyền thực hiện thao tác này!'));
        }
        $user = \App\Models\User::find($id);
        $data = $user->tinTuc()->latest()->paginate(10);
        return view('/User/ListUsers/TinTucUser',compact('data','user'));
    }

    /**
     * Thay đổi ảnh đại diện
     */
    public function view_Edit_Image($id){
        $user = User::find($id);
        return view('User.ListUsers.ListUserUploadImg',compact('user'));
    }

    public function update_Image(Request $request, $id){
        $user = User::find($id);
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
            $imgName = date('H-i-s-d-m-Y').'-'.$user->username.'-'.$imgRequest->getClientOriginalName();
            Storage::delete($user->image);
            $imgUploaded = $imgRequest->storeAs('/public/image',$imgName);
            $user->image = $imgUploaded;
            $updated = $user->update();
            if($updated){
                return redirect()->route('list.getUser',['id'=>$user->user_id])->with('success','Bạn đã cập nhật thành công !!');
            }
            else
            {
                return redirect()->back()->with('error', 'Cập nhật thất bại hãy thử lại!');
            }
        }

    }

}
