<?php

namespace App\Http\Controllers\Timkiem;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LoaiSanPham;
use App\Models\NhaSanXuat;
use App\Models\SanPham;
use App\Models\TinTuc;
use Carbon\Carbon;

class SearchController extends Controller
{
    public function getSearch(Request $request){
        return view ('Search.TimKiem');
    }

    public function postSearch(Request $request)
    {
        if($request->get('query'))
        {
            $query = $request->get('query');
            $output = '';

            $users = User::where(function($user) use($query){
                $user->where('username','LIKE', '%' . $query . '%')
                ->orwhere('email','LIKE', '%' . $query . '%')
                ->orwhere('fullname','LIKE', '%' . $query . '%');
            });


            $tinTuc = TinTuc::where(function($tintuc) use($query){
                $tintuc->where('tintuc_tieude','LIKE', '%' . $query . '%');
            });

            $Sp = SanPham::where(function($sp) use($query){
                $sp->where('sp_ten','LIKE', '%' . $query . '%');
            });

            $nsx = NhaSanXuat::where(function($nsx) use($query){
                $nsx->where('nsx_ten','LIKE', '%' . $query . '%');
            });

            //Render danh sách người dùng
            if($users->count() > 0){
                $ListUser = $users->get();
                $output .=
                    '
                    <div class="text-left m-lg-6" style="display: flex; justify-content: flex-start; align-content: center; align-items: center;">
                        <i class="fa-solid fa-users" style="margin-right: 0.5rem;"></i>
                        <h6 width="30%;">Danh sách người dùng được tìm thấy</h6>
                    </div>
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="font-weight: 700;">STT</th>
                                <th scope="col" style="font-weight: 700;">Họ Tên</th>
                                <th scope="col" style="font-weight: 700;">Tên tài khoản</th>
                                <th scope="col" style="font-weight: 700;">E-mail</th>
                                <th scope="col" style="font-weight: 700;">Tuổi</th>
                                <th scope="col" style="font-weight: 700;">Thời gian</th>

                            </tr>
                        </thead><tbody>';
                foreach($ListUser as $key => $user)
                {
                    $index = $key +1;
                    $date_format = date_format(date_create_from_format('d/m/Y',$user->birthdate),'Y/m/d');
                    $age = Carbon::parse($date_format)->diff(Carbon::now())->format('%y');
                    $output .=
                    '

                        <tr id="redirectToUrl" data-redirect-url = "'.route('list.getUser',['id'=>$user->user_id]).'">
                        <td>'.$index.'</td>
                        <td>'.$user->fullname.'</td>
                        <td>'.$user->username.'</td>
                        <td>'.$user->email.'</td>
                        <td>'.$age.'</td>
                        <td>'.date_format($user->updated_at,'H:i:s d/m/Y').'</td>
                        </tr>
                        </a>
                    ';
                }
                $output .= '</tbody></table>';
            }

            //Render ra danh sách tin tức
            if($tinTuc->count() > 0){
                $list_TinTuc = $tinTuc->get();
                $output .=
                    '
                    <div class="text-left m-lg-6" style="display: flex; justify-content: flex-start; align-content: center; align-items: center;">
                        <i class="fa-solid fa-newspaper" style="margin-right: 0.5rem;"></i>
                        <h6 width="30%;">Danh sách tin tức được tìm thấy</h6>
                    </div>
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="font-weight: 700;">STT</th>
                                <th scope="col" style="font-weight: 700;width: 15%;">Tiêu đề</th>
                                <th scope="col" style="font-weight: 700;">Tóm tắt</th>
                                <th scope="col" style="font-weight: 700;">Người đăng</th>
                                <th scope="col" style="font-weight: 700;">Thời gian</th>

                            </tr>
                        </thead><tbody>';
                foreach($list_TinTuc as $key => $tintuc)
                {
                    $index = $key +1;
                    $output .=
                    '
                        <tr id="redirectToUrl" data-redirect-url = "'.route('tintuc.doc',['id'=>$tintuc->tintuc_id]).'">
                        <td>'.$index.'</td>
                        <td>'.substr($tintuc->tintuc_tieude,0,30).'</td>
                        <td>'.substr($tintuc->tintuc_tomtat,0,35).'</td>
                        <td>'.$tintuc->user->username.'</td>
                        <td>'.$tintuc->tintuc_capnhat.'</td>
                        </tr>
                    ';
                }
                $output .= '</tbody></table>';
            }

            //Render danh sách sản phẩm tìm thấy
            if($Sp->count() > 0){
                $list_Sp = $Sp->get();
                $output .=
                    '
                    <div class="text-left m-lg-6" style="display: flex; justify-content: flex-start; align-content: center; align-items: center;">
                        <i class="fa-solid fa-shop" style="margin-right: 0.5rem;"></i>
                        <h6 width="30%;">Danh sách Sản phẩm được tìm thấy</h6>
                    </div>
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="font-weight: 700;">STT</th>
                                <th scope="col" style="font-weight: 700;">Tên sản phẩm</th>
                                <th scope="col" style="font-weight: 700;">Thông tin</th>
                                <th scope="col" style="font-weight: 700;">Giá</th>
                                <th scope="col" style="font-weight: 700;">Thời gian</th>

                            </tr>
                        </thead><tbody>';
                foreach($list_Sp as $key => $sp)
                {
                    $index = $key +1;
                    $output .=
                    '
                        <tr id="redirectToUrl" data-redirect-url = "'.route('sp.xem',['id'=>$sp->sp_id]).'">
                        <td>'.$index.'</td>
                        <td>'.$sp->sp_ten.'</td>
                        <td>'.substr($sp->sp_thongtin,0,35).'</td>
                        <td>'.$sp->sp_gia.'</td>
                        <td>'.$sp->sp_capnhat.'</td>
                        </tr>
                    ';
                }
                $output .= '</tbody></table>';
            }

            //render danh sách nhà sản xuất tìm thấy
            if($nsx->count() > 0){
                $list_nsx = $nsx->get();
                $output .=
                    '
                    <div class="text-left m-lg-6" style="display: flex; justify-content: flex-start; align-content: center; align-items: center;">
                    <i class="fa-solid fa-building" style="margin-right: 0.5rem;"></i>
                        <h6 width="30%;">Danh sách Nhà sản xuất được tìm thấy</h6>
                    </div>
                    <table class="table table-hover table-nowrap">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" style="font-weight: 700;">STT</th>
                                <th scope="col" style="font-weight: 700;">Tên nhà sản xuất</th>
                                <th scope="col" style="font-weight: 700;">Thông tin</th>
                                <th scope="col" style="font-weight: 700;">Thời gian</th>

                            </tr>
                        </thead><tbody>';
                foreach($list_nsx as $key => $Nsx)
                {
                    $index = $key +1;
                    $output .=
                    '
                        <tr id="redirectToUrl" data-redirect-url = "'.route('nsx.xem',['id'=>$Nsx->nsx_id]).'">
                        <td>'.$index.'</td>
                        <td>'.$Nsx->nsx_ten.'</td>
                        <td>'.substr($Nsx->nsx_mota,0,50).'</td>
                        <td>'.$Nsx->nsx_capnhat.'</td>
                        </tr>
                    ';
                }
                $output .= '</tbody></table>';
            }
            if($users->count() == 0 && $Sp->count() == 0 && $tinTuc->count() == 0 && $nsx->count() == 0)
            {
                $output = '
                <div class="text-left m-lg-6" style="display: flex; justify-content: flex-start; align-content: center; align-items: center;">
                    <p>Không tìm thấy giá trị nào khớp!</p>
                </div>';
            };
           echo $output;
       }
    }
}
