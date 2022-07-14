<?php

namespace App\Http\Controllers\TinTuc;

use App\Http\Controllers\Controller;

use App\Models\TinTuc;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;

class TinTucController extends Controller
{

    public function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }

    /**
     * Trang danh sách tin tức
     */
    public function tinTucDS(){
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền thực hiện thao tác này!'));
        }
        $ds = TinTuc::orderBy('tintuc_taomoi','desc')->paginate(10);

        return view('/TinTuc/DsTinTuc',compact('ds'));
    }

    /**
     * Đọc 1 bài viết
     */
    public function docTinTuc($id){
        $tinTuc = TinTuc::find($id);
        $nguoiDang = $tinTuc->user_id;
        $auth = auth()->user()->user_id;
        if($nguoiDang == $auth || auth()->user()->role == 'admin'){
            $tinTuc = TinTuc::find($id);
            return view('/TinTuc/DocTinTuc',compact('tinTuc'));
        }
        abort('403',__('Bạn không có quyền truy cập trang này'));
    }

    /**
     * Xoá bài viết
     */
    public function xoaTinTuc($id){
        $tinTuc = TinTuc::find($id);
        $nguoiDang = $tinTuc->user_id;
        $auth = auth()->user()->user_id;
        if($nguoiDang == $auth || auth()->user()->role == 'admin'){
            $deleted = $tinTuc->delete();
            if($deleted){
                return redirect()->route('tintuc.danhsach')->with('success','Bạn đã xoá bài viết thành công');
            }
            else
            {
                return redirect()->back()->with('error','Bạn không thể xoá bài viết lúc này!');
            }
        }
        else
        {
            return redirect()->back()->with('error','Bạn không phải người đăng nên không thể xoá bài viết!');
        }
    }

    /**
     * Sửa bài viết
     */

    //-------Hiển thị trang sửa bài viết--------------

    public function suaTinTucView($id){
        $tinTuc = TinTuc::find($id);
        $nguoiDang = $tinTuc->user_id;
        $auth = auth()->user()->user_id;
        if($auth == $nguoiDang || auth()->user()->role == 'admin'){
            return view('TinTuc/suaTinTuc',compact('tinTuc'));
        }
    }
    //-------Xử lý sửa bài viết-----------------------
    public function suaTinTuc(Request $request,$id){
        $baiviet = TinTuc::find($id);
        $rules = [
            'tieude'=>['required'],
            'tomtat' => ['required','max:1000','min:30'],
            'noidung' => ['required','min:30']
        ];

        $messages = [
            'required' => ':attribute không được để trống !',
            'max'   => ':attribute đã vượt quá số ký tự cho phép !',
            'min'   => ':attribute ít nhất phải :min ký tự',
        ];

        $attributes = [
            'tieude'=>'Tiêu đề',
            'tomtat' => 'Tóm tắt bài viết',
            'noidung' => 'Nội dung',
        ];
        $data = $request->except('_token');
        $validated = $request->validate($rules,$messages,$attributes);
        $baiviet->tintuc_tieude = $data['tieude'];
        $baiviet->tintuc_tomtat = $data['tomtat'];
        $baiviet->tintuc_noidung = $data['noidung'];
        if(isset($data['trangthai'])){
            $baiviet->tintuc_trangthai = true;
        }
        else
        {
            $baiviet->tintuc_trangthai = false;
        }
        $updated = $baiviet->update();
        if($updated){
            return redirect()->route('tintuc.doc',['id'=>$baiviet->tintuc_id])->with('success','Bạn đã cập nhật thành công!');
        }
        else
        {
            return redirect()->back()->with('error','Bạn chưa thể cập nhật lúc này hãy kiểm tra lại!');
        }
    }
        /***
         * Tạo bài viết mới
         */
        //---------Trang viết bài mới
        public function taoMoiTinTucView(){
            if(auth()->check()){
                return view('/TinTuc/TaoMoiTinTuc');
            }
            else
            {
                return route('getLogin');
            }
        }
        //---------Xử lý bài viết tạo mới
        public function taoMoiTinTuc(Request $request){
            $baiVietMoi =  new TinTuc;
            $rules = [
                'tieude'=>['required'],
                'tomtat' => ['required','max:1000','min:30'],
                'noidung' => ['required','min:30']
            ];

            $messages = [
                'required' => ':attribute không được để trống !',
                'max'   => ':attribute đã vượt quá số ký tự cho phép !',
                'min'   => ':attribute ít nhất phải :min ký tự',
            ];

            $attributes = [
                'tieude'=>'Tiêu đề',
                'tomtat' => 'Tóm tắt bài viết',
                'noidung' => 'Nội dung',
            ];
            $data = $request->except('_token');
            $validated = $request->validate($rules,$messages,$attributes);
            $baiVietMoi->tintuc_tieude = $data['tieude'];
            $baiVietMoi->tintuc_tomtat = $data['tomtat'];
            $baiVietMoi->tintuc_noidung = $data['noidung'];
            $baiVietMoi->user_id = auth()->user()->user_id;
            if(isset($data['trangthai'])){
                $baiVietMoi->tintuc_trangthai = true;
            }
            else
            {
                $baiVietMoi->tintuc_trangthai = false;
            }
            $saved = $baiVietMoi->save();
            if($saved){
                return redirect()->route('tintuc.doc',['id'=>$baiVietMoi->tintuc_id])->with('success','Bạn đã đăng bài thành công!');
            }
            else
            {
                return redirect()->back()->with('error','Bạn chưa thể tạo bài viết mới lúc này hãy kiểm tra lại!');
            }
        }
}
