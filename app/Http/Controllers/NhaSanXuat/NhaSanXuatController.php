<?php

namespace App\Http\Controllers\NhaSanXuat;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\NhaSanXuat;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Gate;

use Illuminate\Support\Facades\Auth;

class NhaSanXuatController extends Controller
{
    public function userCan($action,$option = NULL)
    {
        $user= Auth::user();
        return Gate::forUser($user)->allows($action,$option);
    }

    /***
     * ------------------Tạo nhà sản xuất mới----------------------------
     */

     /**
      * Hiển thị trang tạo mới
      */
    public function viewTaoNsx(){
        //Chỉ cho phép admin mới được tạo nhà sản xuất
        if(!$this->userCan('is-admin')){
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }

        // return view
        return view('/NhaSanXuat/ViewTaoNsx');
    }

    /***
     * Xử lý form tạo NSX mới
     */
    public function taoNsx(Request $request){
        if(!$this->userCan('is-admin')){
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $data = $request->except('_token');
        $nsx = new NhaSanXuat;
        $imgRequest = $request->nsx_hinhanh;
        $imgName = date('H-m-i-d-m-Y').'-'.$data['nsx_ten'].'-'.$imgRequest->getClientOriginalName();
        $pathImg = Storage::url($imgRequest->storeAs('public/imgNhaSanXuat',$imgName));
        $data['nsx_hinhanh'] = $pathImg;

        $rules = [
            'nsx_ten' => ['required','min:6','max:100'],
            'nsx_mota'=> ['nullable','min:50','max:10000'],
            'nsx_hinhanh'=>['nullable','max:20000','mimes:jpg,jpeg,gif,png']
        ];

        $messages = [
            'required'=> ':attribute không được để trống',
            'min'=>':attribute phải ít nhất :min ký tự',
            'max'=>':attribute phải nhỏ hơn :max ký tự',
            'mimes'=> ':attribute định dạng không đúng',
        ];

        $attributes = [
            'nsx_ten'=>'Tên nhà sản xuất',
            'nsx_mota'=>'Thông tin nhà sản xuất',
            'nsx_hinhanh'=>'Hình ảnh của nhà sản xuất',
        ];


        if(!empty($data)){
            $validated = $request->validate($rules,$messages,$attributes);
            $nsx->nsx_ten = $data['nsx_ten'];
            $nsx->nsx_mota = $data['nsx_mota'];
            $nsx->nsx_hinhanh = $data['nsx_hinhanh'];
            $saved = $nsx->save();
        }
        if($saved){
            return redirect()->route('nsx.xem',['id'=>$nsx->nsx_id])->with('success','Bạn đã tạo nhà sản xuất mới thành công !');
        }
        else
        {
            return redirect()->back()->with('error', 'Bạn chưa thể tạo Nhà sản xuất mới lúc này !');
        }
    }



    /***
     * ------------------------Danh sách nhà sản xuất---------------------
     */
    public function dsNsx(){
        // if(!$this->userCan('is-guest')){
        //     abort('403',__('Bạn không có quyền truy cập trang này'));
        // }
        $ds = NhaSanXuat::latest()->paginate(10);
        return view('NhaSanXuat/DsNsx', compact('ds'));
    }

    /**
     *
     *----------------------Thông tin chi tiết của nhà sản xuất -----------
     */
    public function xemNsx($id){
        // if(!$this->userCan('is-guest')){
        //     abort('403',__('Bạn không có quyền truy cập trang này'));
        // }
        $nsx = NhaSanXuat::find($id);
        if(!empty($nsx))
        {
            return view('NhaSanXuat/XemNsx',compact('nsx'));
        }
        else
        {
            return redirect()->back()->with('error', 'Hiện tại không có thông tin nào về nhà sản xuất này trong dữ liệu');
        }
    }


    /***
     * ------------------Cập nhật thông tin nhà sản xuất ---------------
     */

    // Hiển thị trang cập nhật
    public function viewSuaNsx($id){
        if(!$this->userCan('is-admin')){
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $nsx = NhaSanXuat::find($id);
        if(!empty($nsx)){
            return view('NhaSanXuat/SuaNsx',compact('nsx'));
        }
        else
        {
            return redirect()->back()->with('error', 'Không tìm thấy nội dung cần sửa!');
        }
    }

    // Xử lý dữ liệu mới cập nhật
    public function SuaNsx(Request $request,$id){
        $nsx = NhaSanXuat::find($id);
        $data = $request->except('_token');
        $rules =
        [
            'nsx_ten'=>["nullable",'min:6','max:100'],
            'nsx_mota'=>['nullable','min:50','max:10000'],
            'nsx_hinhanh'=>['nullable','max:20000','mimes:jpg,jpeg,gif,png']
        ];

        $messages = [
            'required'=> ':attribute không được để trống',
            'min'=>':attribute phải ít nhất :min ký tự',
            'max'=>':attribute phải nhỏ hơn :max ký tự',
            'mimes'=> ':attribute định dạng không đúng',
            'regex'=> ':attribute có định dạng không đúng',
        ];

        $attributes = [
            'nsx_ten'=>'Tên nhà sản xuất',
            'nsx_mota'=>'Thông tin nhà sản xuất',
            'nsx_hinhanh'=>'Hình ảnh của nhà sản xuất',
        ];

        if(!empty($data)){
            $validated = $request->validate($rules,$messages,$attributes);
            if(!empty($request->nsx_hinhanh)){
                $imgRequest = $request->nsx_hinhanh;
                $imgName = date('H-i-s-d-m-Y').'-'.$request->nsx_ten.'-'.$imgRequest->getClientOriginalName();
                Storage::delete($nsx->nsx_hinhanh);
                $imgUploaded =$imgRequest->storeAs('/public/imgNhaSanXuat',$imgName);
                $data['nsx_hinhanh'] = $imgUploaded;
            }
            foreach($data as $key => $val)
            {
                $nsx->$key = $val;
            }
            $updated = $nsx->update();
            if($updated)
            {
                return redirect()->route('nsx.xem',['id'=>$nsx->nsx_id])->with('success','Bạn đã cập nhật thành công');
            }
            else
            {
                return redirect()->back()->with('error','Bạn chưa thể cập nhật thông tin lúc này hãy thử lại sau !');
            }
        }
    }

    /**
     * ---------------------Xoá nhà sản xuất--------------------------
     */
    public function xoaNsx($id){
        if(!$this->userCan('is-admin')){
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $nsx = NhaSanXuat::find($id);
        $image = $nsx->nsx_hinhanh;



           $storeDel =  File::delete($nsx->nsx_hinhanh);
            $deleted = $nsx->delete();
            if($deleted && $storeDel)
            {
                return redirect()->route('nsx.danhsach')->with('success', 'Bạn đã xoá Nhà sản xuất thành công!');
            }
            else
            {
                return redirect()->back()->with('error', 'Bạn không thể xoá nhà sản xuất!');
            }
    }
}
