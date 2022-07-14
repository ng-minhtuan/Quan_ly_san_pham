<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\SanPham;
use App\Models\TinTuc;
use Illuminate\Support\Facades\Date;

class HomeController extends Controller
{
    /**
     * Truy cập trang chủ
     */
    public function index(){
        $dsUser = User::latest()->paginate(10);
        $dsTinTucPublic = TinTuc::latest()->paginate(10);
        $dsSP = SanPham::latest()->paginate(10);
        $dataHome = [
            'dsUser'=>$dsUser,
            'dsTinTucPublic'=>$dsTinTucPublic,
            'dsSanPham'=>$dsSP,
        ];
        return view('home',compact('dataHome'));
    }
}
