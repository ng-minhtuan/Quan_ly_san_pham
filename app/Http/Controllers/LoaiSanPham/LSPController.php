<?php

namespace App\Http\Controllers\LoaiSanPham;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoaiSanPham;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class LSPController extends Controller
{
    public function userCan($action, $option = NULL)
    {
        $user = Auth::user();
        return Gate::forUser($user)->allows($action, $option);
    }
    //Danh sách loại sản phẩm
    public function dsLSP()
    {
        $ds = LoaiSanPham::latest()->paginate(10);
        // dd($ds);
        return view('LoaiSanPham/DsLsp',compact('ds'));
    }

    //Danh sách loại sản phẩm con
    public function ds2($lsp_id)
    {

        $lsp = LoaiSanPham::find($lsp_id);
        return view('LoaiSanPham/xemDanhMuc',compact('lsp'));
    }

    //Thêm loại sản phẩm
    public function viewThemLSP(){
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $ds = LoaiSanPham::whereNull('lsp_parent_id')->get();
        return view('LoaiSanPham/viewThemLSP',compact('ds',$ds));
    }

    //Hàm xử lý thêm loại sản phẩm
    public function themLSP(Request $request){
        $data = $request->except('_token');
        $rules = [
            'lsp_ten'=>['required','min:6','max:100'],
            'lsp_ghichu'=>['nullable','min: 10','max:200'],
            'lsp_parent'=>['required'],
        ];
        $messages = [
            'required'=>':attribute không được bỏ trống!',
            'min'=>':attribute ít nhất phải :min ký tự',
            'max'=>':attribute đã vượt quá số ký tự cho phép, :max ký tự ' ,
        ];
        $attributes = [
            'lsp_ten'=>'Tên danh mục sản phẩm',
            'lsp_ghi chú'=>'Ghi chú cho danh mục',
            'lsp_parent'=> 'Loại danh mục sản phẩm',
        ];
        $validated =$request->validate($rules,$messages,$attributes);
        $lsp = new LoaiSanPham();
        $lsp->lsp_ten = $data['lsp_ten'];
        $lsp->lsp_ghichu = $data['lsp_ghichu'];
        $lsp->lsp_slug = Str::slug($data['lsp_ten']);
        if($data['lsp_parent']== "NULL" || $data['lsp_parent'] == "0" || empty($data['lsp_parent']))
        {
            $lsp->lsp_parent_id = NULL;
            $saved = $lsp->save();
            if($saved){
                return redirect()->route('lsp.danhsach2',['id',$lsp->lsp_id])->with('success','Tạo thêm danh mục sản phẩm mới thành công');
            }
        }
        else
        {
            $lsp_parent = LoaiSanPham::where('lsp_ten',$data['lsp_parent'])->first();
            $lsp->lsp_parent_id = $lsp_parent->lsp_id;
            $saved = $lsp->save();
            if($saved){
                return redirect()->route('lsp.danhsach2',['id'=>$lsp->lsp_id])->with('success','Tạo thêm danh mục sản phẩm thành công!');
            }
        }
        if(!$saved){
            return redirect()->back()->with('error','Tạo thêm danh mục sản phẩm không thành công');
        }
    }

    //Sửa danh mục sản phẩm
    public function viewSuaLSP($id)
    {
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $ds = LoaiSanPham::whereNull('lsp_parent_id')->get();
        $lsp = LoaiSanPham::find($id);
        if($lsp->lsp_parent_id == NULL){
        return view('LoaiSanPham/viewSuaLSP',compact('lsp','ds'));
        }
        else
        {
            $parent = $lsp->lsp_parent->lsp_ten;
            return view('LoaiSanPham/viewSuaLSP',compact('lsp','ds','parent'));
        }
    }

    //Hàm xử lý sửa loại sản phẩm
    public function suaLSP(Request $req ,$lsp_id){
        $lsp = LoaiSanPham::find($lsp_id);
        $data = $req-> except('_token');
        $rules = [
            'lsp_ten'=>['nullable','min:6','max:100','unique:App\Models\LoaiSanPham,lsp_ten'],
            'lsp_ghichu'=>['nullable','min: 10','max:200'],
            'lsp_parent'=>['required'],
        ];
        $messages = [
            'required'=>':attribute không được bỏ trống!',
            'min'=>':attribute ít nhất phải :min ký tự',
            'max'=>':attribute đã vượt quá số ký tự cho phép, :max ký tự ' ,
            'unique'=>':attribute đã có trong dữ liệu'
        ];
        $attributes = [
            'lsp_ten'=>'Tên danh mục sản phẩm',
            'lsp_ghi chú'=>'Ghi chú cho danh mục',
            'lsp_parent'=> 'Loại danh mục sản phẩm',
        ];
        $validated =$req->validate($rules,$messages,$attributes);
        if(!empty($data['lsp_ten']))
        {
            $lsp->lsp_ten = $data['lsp_ten'];
            $lsp->lsp_slug = Str::slug($data['lsp_ten']);
        }
        if(!empty($data['lsp_ghichu']))
        {
            $lsp->lsp_ghichu = $data['lsp_ghichu'];

        }
        if($data['lsp_parent']== "NULL" || $data['lsp_parent'] == "0" || empty($data['lsp_parent']))
        {
            $lsp->lsp_parent_id = NULL;
            $updated = $lsp->update();
            if($updated){
                return redirect()->route('lsp.danhsach2',['id',$lsp->lsp_id])->with('success','Sửa thêm danh mục sản phẩm mới thành công');
            }
        }
        else
        {
            $lsp_parent = LoaiSanPham::where('lsp_ten',$data['lsp_parent'])->first();
            $lsp->lsp_parent_id = $lsp_parent->lsp_id;
           
            $updated = $lsp->update();
            if($updated){            
                return redirect()->route('lsp.danhsach2',['id',$lsp->lsp_id])->with('success','Sửa thêm danh mục sản phẩm mới thành công');
            }
        }
        if(!$updated)
        {
            return redirect()->back()->with('error','Sửa danh mục sản phẩm không thành công');
        }
    }



    //Xoá danh mục sản phẩm
    public function xoaLSP($lsp_id){
        if(!$this->userCan('is-admin'))
        {
            abort('403',__('Bạn không có quyền truy cập trang này'));
        }
        $lsp = LoaiSanPham::find($lsp_id);
        $deleted = $lsp->delete();
        if($deleted){
            return redirect()->back()->with('Bạn đã xoá danh mục sản phẩm thành công!');
        }
        else
        {
            return redirect()->back()->with('error','Bạn chưa thể xoá danh mục sản phẩm !');
        }
    }
}
