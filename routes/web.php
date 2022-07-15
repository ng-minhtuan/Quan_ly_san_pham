<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/***
 * Truy Cập trang chủ
 */
use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth','active');

/**
 * Đăng nhập
 */
use App\Http\Controllers\CustomAuth\LoginController;
Route::get('dang-nhap',[LoginController::class,'getLogin'])->name('getLogin');
Route::post('dang-nhap',[LoginController::class,'postLogin'])->name('postLogin');


/**
 * Đăng ký tài khoản
 */
use App\Http\Controllers\CustomAuth\RegisterController;
Route::get('dang-ky',[RegisterController::class,'getRegister'])->name('getRegister');
Route::post('dang-ky',[RegisterController::class,'postRegister'])->name('postRegister');

/**
 * Đăng xuất tài khoản
 */
use App\Http\Controllers\CustomAuth\LogoutController;
Route::post('dang-xuat',[LogoutController::class,'logout'])->name('logout');

/**
 * Xác thực Email
 */
use App\Http\Controllers\CustomAuth\VerifyEmailController;
Route::prefix('verify-email')->group(function(){
    //View gửi mail xác thực
    Route::get('/',[VerifyEmailController::class,'view_Xac_Thuc'])->name('xacthuc.view');

    //Gửi mail xác thực
    Route::post('/',[VerifyEmailController::class,'send_Mail'])->name('sendmail');

    //View xác thực với code
    Route::get('active',[VerifyEmailController::class,'view_Check_Code'])->name('view.checkcode');

    //Xử lý code xác thực
    Route::post('active',[VerifyEmailController::class,'check_Code'])->name('checkcode');
});




/**
 * ----------------------------------Người dùng sau khi đăng nhập------------------------------------------------
*/
/**
 * Trang thông tin cá nhân
 */

use App\Http\Controllers\User\UserProfileController;

Route::get('thong-tin-ca-nhan',[UserProfileController::class,'getProfile'])->middleware('auth')->name('user.profile');


/**
 * Sửa thông tin cá nhân
 */

Route::get('edit-profile',[UserProfileController::class,'getEdit'])->middleware('auth')->name('user.getEdit');
Route::post('update-profile',[UserProfileController::class,'updateProfile'])->middleware('auth')->name('user.update');

/**
 * Đổi ảnh đại diện
 */
Route::get('update-image',[UserProfileController::class,'viewUpdateImage'])->middleware('auth')->name('user.viewupdateimg');
Route::post('update-image',[UserProfileController::class,'updateImage'])->middleware('auth')->name('user.updateImage');

/**
 * Xoá tài khoản cá nhân
 */

Route::post('delete-profile',[UserProfileController::class,'deleteUser'])->middleware('auth')->name('user.delete');

/**
 * -----------------------------Danh sách người dùng---------------------------------
 */
use App\Http\Controllers\ListUsers\ListUsersController;

Route::prefix('users')->middleware('auth')->group(function(){
    /**
     * Truy cập trang danh sách User
     */
    Route::get('danh-sach-nguoi-dung',[ListUsersController::class,'getList'])->name('list.get');

    /**
     * Xem thông tin người dùng khác
     */
    Route::get('get/{id}',[ListUsersController::class,'getUser'])->name('list.getUser');

    /**
     * Sửa thông tin người dùng khác
     */
    Route::get('edit/{id}',[ListUsersController::class,'editUser'])->name('list.editUser');
    Route::post('update/{id}',[ListUsersController::class,'updateUser'])->name('list.updateUser');


    /***
     * Sửa ảnh đại diện của người dùng
     */
    Route::get('edit-image/{id}',[ListUsersController::class,'view_Edit_Image'])->name('list.editImage');
    Route::post('edit-image/{id}',[ListUsersController::class,'update_Image'])->name('list.updateImage');


    /**
     * Xoá tài khoản người dùng
     */
    Route::post('delete/{id}',[ListUsersController::class,'deleteUser'])->name('list.deleteUser');

    /**
     * Xem những bài viết đã đăng
     */
    Route::get('tin-tuc/{id}',[ListUsersController::class,'showListTinTuc'])->name('list.tintuc');
});
/**
 * -----------------------------------Tin Tức----------------------------------------------------
 */

use App\Http\Controllers\TinTuc\TinTucController;

Route::prefix('tin-tuc')->middleware('auth')->group(function(){

    /**
     * Danh sách tin tức
     */
    Route::get('danh-sach',[TinTucController::class, 'tinTucDS'])->name('tintuc.danhsach');

    /**
     * Đọc tin tức
     */
    Route::get('read/{id}',[TinTucController::class, 'docTinTuc'])->name('tintuc.doc');

    /**
     * Xoá bài viết
     */
    Route::post('delete/{id}',[TinTucController::class, 'xoaTinTuc'])->middleware('auth')->name('tintuc.xoa');

    /**
     * Sửa bài viết
     */
    Route::get('sua/{id}',[TinTucController::class, 'suaTinTucView'])->middleware('auth')->name('tintuc.viewsua');
    Route::post('sua/{id}',[TinTucController::class, 'suaTinTuc'])->middleware('auth')->name('tintuc.sua');

    /**
     * Viết bài mới
     */
    Route::get('taomoi',[TinTucController::class, 'taoMoiTinTucView'])->middleware('auth')->name('tintuc.viewtaomoi');
    Route::post('taomoi',[TinTucController::class, 'taoMoiTinTuc'])->middleware('auth')->name('tintuc.taomoi');
});



/**
 * --------------------------Nhà Sản Xuất-----------------------------------
 */

use App\Http\Controllers\NhaSanXuat\NhaSanXuatController;
Route::prefix('nha-san-xuat')->middleware('auth')->group(function(){

    // Danh sách nhà sản xuất
    Route::get('danh-sach',[NhaSanXuatController::class,'dsNsx'])->name('nsx.danhsach');

    // Tạo nhà sản xuất mới
    Route::get('tao-moi',[NhaSanXuatController::class,'viewTaoNsx'])->middleware('auth')->name('nsx.viewtaomoi');
    Route::post('tao-moi',[NhaSanXuatController::class,'taoNsx'])->name('nsx.taomoi');

    //Thông tin chi tiết của nhà sản xuất
    Route::get('thong-tin-chi-tiet/{id}',[NhaSanXuatController::class,'xemNsx'])->name('nsx.xem');

    //Cập nhật thông tin nhà sản xuất
    Route::get('cap-nhat-thong-tin/{id}',[NhaSanXuatController::class,'viewSuaNsx'])->middleware('auth')->name('nsx.viewsua');
    Route::post('cap-nhat-thong-tin/{id}',[NhaSanXuatController::class,'suaNsx'])->middleware('auth')->name('nsx.capnhat');

    //Xoá thông tin nhà sản xuất
    Route::post('xoa-nha-san-xuat/{id}',[NhaSanXuatController::class,'xoaNsx'])->middleware('auth')->name('nsx.xoa');

});


/**
 * --------------------------Loại Sản Phẩm--------------------------
 */
use App\Http\Controllers\LoaiSanPham\LSPController;
Route::prefix('loai-san-pham')->middleware('auth')->group(function(){
    //Danh sách loại sản phẩm
    Route::get('/',[LSPController::class, 'dsLSP'])->name('lsp.danhsach');

    //Danh sách chi tiết của danh mục
    Route::get('danh-sach/{id}',[LSPController::class, 'ds2'])->name('lsp.danhsach2');

    //Thêm loại sản phẩm
    Route::get('them-loai-san-pham',[LSPController::class,'viewThemLSP'])->name('lsp.viewthem');
    Route::post('them-loai-san-pham',[LSPController::class,'themLSP'])->name('lsp.them');

    //Sửa loại sản phẩm
    Route::get('sua-loai-san-pham/{lsp_id}',[LSPController::class,'viewSuaLSP'])->name('lsp.viewsua');
    Route::post('sua-loai-san-pham/{lsp_id}',[LSPController::class,'suaLSP'])->name('lsp.sua');

    //Xoá loại sản phẩm
    Route::post('xoa-loai-san-pham/{lsp_id}',[LSPController::class, 'xoaLSP'])->name('lsp.xoa');
});

/**
 * --------------------------Sản phẩm--------------------------------
 *
 */
use App\Http\Controllers\SanPham\SanPhamController;
Route::prefix('san-pham')->middleware('auth')->group(function(){

        //Toàn bộ danh sách sản phẩm
        Route::get('danh-sach',[SanPhamController::class,'dsSanpham'])->name('sp.danhsach');

        //Xem sản phẩm
        Route::get('danh-sach/{id}',[SanPhamController::class,'xemSp'])->name('sp.xem');

        //Thêm sản phẩm
        Route::get('them-san-pham',[SanPhamController::class,'viewThemSp'])->name('sp.viewthem');
        Route::post('them-san-pham',[SanPhamController::class,'themSp'])->name('sp.them');

        //Xoá sản phẩm
        Route::post('xoa-san-pham/{id}',[SanPhamController::class,'xoaSp'])->name('sp.xoa');

        //Sửa thông tin sản phẩm
        Route::get('sua-san-pham/{id}',[SanPhamController::class,'viewsuaSp'])->name('sp.viewsua');
        Route::post('sua-san-pham/{id}',[SanPhamController::class,'suaSp'])->name('sp.sua');

});

/**
 * ---------------------Tìm kiếm-----------------------------------
*
*/
use App\Http\Controllers\Timkiem\SearchController;
Route::get('search', [SearchController::class, 'getSearch'])->middleware('auth')->name('search.get');
Route::post('search', [SearchController::class,'postSearch'])->name('search');
