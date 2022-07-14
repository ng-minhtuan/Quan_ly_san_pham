<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id')->commnet('Khoá chính của bảng Users');
            $table->string('fullname',100)->comment('Họ và Tên người dùng');
            $table->string('username',100)->comment('Tên tài khoảng');
            $table->string('email')->comment('Địa chỉ Email');
            $table->timestamp('email_verified_at')->nullable()->comment(' Thời gian Xác thực bằng Email');
            $table->string('confirm_code')->nullable()->comment('Mã xác nhận Email');
            $table->boolean('confirmed')->default(0)->comment('Tình trạng xác thực');
            $table->string('gender')->comment('Giới tính');
            $table->string('birthdate')->comment('Ngày tháng năm sinh');
            $table->string('image')->comment('Ảnh đại diện');
            $table->string('password')->comment('Mật khẩu đăng nhập');
            $table->string('role')->comment('Phân quyền người dùng');
            $table->rememberToken();
            $table->softDeletes()->nullable();
            $table->timestamps();
            $table->unique(['email','username','confirm_code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
