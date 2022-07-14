<?php

namespace App\Http\Controllers\SanPham;

use App\Models\SanPham;
use App\Models\LoaiSanPham;
use App\Models\NhaSanXuat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    //Khai báo Gate phân quyền
    public function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }

    //Danh sách sản phẩm
    public function dsSanPham(){
        // if(!$this->userCan('is-guest')){
        //     abort('403',__('Bạn không có quyền truy cập trang này'));
        // }
        $ds = SanPham::latest()->paginate(9);
        foreach($ds as $sp){
            $sp->sp_hinhanh = Storage::URL($sp->sp_hinhanh);
        }
        // dd($ds);
        return view('/SanPham/DsSP',compact('ds'));
    }

    //Xem sản phẩm
    public function xemSp($id)
    {
        // if(!$this->userCan('is-guest')){
        //     abort('403',__('Bạn không có quyền truy cập trang này'));
        // }
        $sp = SanPham::find($id);
        $sp->sp_hinhanh = Storage::url($sp->sp_hinhanh);
        return view('SanPham/XemSp',compact('sp'));
    }

    //Thêm sản phẩm
    public function viewThemSp(){
        if(!$this->userCan('is-admin')){
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $danh_muc_sp = LoaiSanPham::get();
        $ds_nsx = NhaSanXuat::get();
        $data = [
            'danh_muc'=>$danh_muc_sp,
            'nsx'=>$ds_nsx,
        ];
        return view('SanPham/ThemSp',compact('data'));
    }

    //Hàm xử lý thêm sản phẩm
    public function themSp(Request $request){
        $data = $request->except('_token');
        $san_pham = new SanPham();
        $rules = [
            'sp_ten'=>['required','min:8','max:50','unique:App\Models\SanPham,sp_ten'],
            'sp_gia'=>['integer','min:1000'],
            'sp_thongtin'=>['max:1000'],
            'lsp'=>['required'],
            'nsx'=>['required'],
            'sp_hinhanh'=>['required','mimes:jpg,jpeg,gif,png','max:200000'],
        ];
        $messages = [
            'required'=> ':attribute không được phép bỏ trống',
            'min'=> ':attribute quá ngắn!',
            'max'=> ':attribute quá giới hạn cho phép',
            'integer'=> ':attribute phải là số',
            'mimes'=> ':attribute không đúng định dạng cho phép',
            'unique'=>':attribute đã tồn tại',
        ];
        $attributes = [
            'sp_ten'=> 'Tên sản phẩm',
            'sp_gia'=> 'Giá của sản phẩm',
            'sp_thongtin'=> 'Thông tin về sản phẩm',
            'lsp'=> ' Danh mục sản phẩm',
            'nsx'=>'Nhà sản xuất',
            'sp_hinhanh'=>'Hình ảnh sản phẩm',
        ];

        if(!empty($data))
        {
            $validated = $request->validate($rules, $messages, $attributes);
        }

        $san_pham->sp_ten = $data['sp_ten'];
        $san_pham->sp_gia = $data['sp_gia'];
        $san_pham->sp_thongtin = $data['sp_thongtin'];

        if(!empty($data['lsp']) || $data['lsp'] != NULL)
        {
        $lsp_ten = $data['lsp'];
        $lsp = LoaiSanPham::where('lsp_ten', $lsp_ten)->first();
        $lsp_id = $lsp->lsp_id;
        $san_pham->lsp_id = $lsp_id;
        }

        if(!empty($data['nsx']) || $data['nsx'] != NULL)
        {
            $nsx_ten = $data['nsx'];
            $nsx = NhaSanXuat::where('nsx_ten', $nsx_ten)->first();
            $nsx_id = $nsx->nsx_id;
            $san_pham->nsx_id = $nsx_id;
        }

        if(!empty($data['sp_hinhanh']))
        {
            $img = $request->sp_hinhanh;
            $img_ten = date('H-i-s-d-m-Y').'-'.$data['sp_ten'].'-'.$img->getClientOriginalName();
            $store = $img->storeAs('/public/imgSanPham',$img_ten);
            if($store)
            {
                $san_pham->sp_hinhanh = $store;
            }
        }

        $saved = $san_pham->save();
        if($saved)
        {
            return redirect()->action([SanPhamController::class,'xemSp'],['id'=>$san_pham->sp_id])->with('success','Bạn đã tạo sản phẩm thành công!');
        }
        else
        {
            return redirect()->back()->with('error','Bạn tạo sản phẩm mới không thành công!');
        }
    }

    //Xoá sản phẩm
    public function xoaSp($id){

        if(!$this->userCan('is-admin')){
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $sp = SanPham::find($id);
        if(isset($sp)){
            $deleted = $sp->delete();
        }
        if($deleted){
            return redirect()->route('sp.danhsach')->with('success','Bạn đã xoá sản phẩm thành công!');
        }
        else
        {
            return redirect()->back()->with('error','Bạn không thể xoá sản phẩm lúc này!');
        }
    }


    // View Sửa sản phẩm
    public function viewsuaSp($id)
    {
        if(!$this->userCan('is-admin')){
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $sp = SanPham::find($id);
        $sp->sp_hinhanh = storage::url($sp->sp_hinhanh);
        $dslsp= LoaiSanPham::get();
        $dsnsx = NhaSanXuat::get();
        return view('/SanPham/viewSuaSp', compact('sp','dslsp','dsnsx'));
    }

    //xử lý sửa sản phẩm
    public function suaSp(Request $request,$id)
    {
        $sp = SanPham::find($id);
        $rules = [
            'sp_ten'=> ['nullable', 'min:8','max:50'],
            'sp_gia'=>['integer','min:1000'],
            'sp_thongtin'=>['max:1000'],
            'lsp'=>['nullable'],
            'nsx'=>['nullable'],
            'sp_hinhanh'=>['nullable','mimes:jpg,jpeg,gif,png','max:200000'],
        ];
        $messages = [
            'min'=> ':attribute quá ngắn!',
            'max'=> ':attribute quá giới hạn cho phép',
            'integer'=> ':attribute phải là số',
            'mimes'=> ':attribute không đúng định dạng cho phép',
            'unique'=>':attribute đã tồn tại',
        ];
        $attributes = [
            'sp_ten'=> 'Tên sản phẩm',
            'sp_gia'=> 'Giá của sản phẩm',
            'sp_thongtin'=> 'Thông tin về sản phẩm',
            'lsp'=> ' Danh mục sản phẩm',
            'nsx'=>'Nhà sản xuất',
            'sp_hinhanh'=>'Hình ảnh sản phẩm',
        ];
        $validated = $request->validate($rules,$messages,$attributes);
        if(!empty($request->sp_ten)|| $request->sp_ten != $sp->sp_ten)
        {
            $sp->sp_ten = $request->sp_ten;
        }

        if(!empty($request->sp_gia))
        {
            $sp->sp_gia = $request->sp_gia;
        }

        if(!empty($request->sp_thongtin)){
            $sp->sp_thongtin = $request->sp_thongtin;
        }

        if(!empty($request->lsp))
        {
            $lsp = LoaiSanPham::where('lsp_ten', $request->lsp)->get();
            $lsp_id = $lsp->lsp_id;
            if($lsp_id != $sp->lsp_id)
            {
                $sp->lsp_id = $lsp_id;
            }
        }

        if(!empty($request->nsx))
        {
            $nsx_id = NhaSanXuat::where('nsx_ten',$request->nsx)->get()->nsx_id;
            if($nsx_id != $sp->nsx_id)
            {
                $sp->nsx_id = $nsx_id;
            }
        }

        if(!empty($request->sp_hinhnanh))
        {
            $img = $request->sp_hinhanh;
            $imgName = date('H-i-s-d-m-Y').'-'.$sp->sp_ten.'-'.$img->getClientOriginalName();
            Storage::delete($sp->sp_hinhanh);
            $path = $img->storeAs('/public/imgSanPham',$imgName);
            $sp->sp_hinhanh = $path;
        }
        $updated = $sp->update();
        if($updated)
        {
            return redirect()->action([SanPhamController::class,'xemSp'],['id'=>$sp->sp_id])->with('success','Bạn đã cập nhật thành công!');

        }
        else
        {
            return redirect()->back()->with('error','Cập nhật thông tin sản phẩm khôgn thành công!');
        }
    }
}
