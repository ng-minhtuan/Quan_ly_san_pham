<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateNhaSanXuatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nha_san_xuats', function (Blueprint $table) {
            $table->bigIncrements('nsx_id')->comment('Khoá chính Id của nhà sản xuất');
            $table->string('nsx_ten')->comment('Tên nhà sản xuất');
            $table->longtext('nsx_mota')->comment('Giới thiệu về nhà sản xuất');
            $table->string('nsx_hinhanh')->comment('Hình ảnh của nhà sản xuất');
            $table->timestamp('nsx_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian cập nhật thông tin của nhà sản xuất');
            $table->timestamp('nsx_taomoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian tạo nhà sản xuất mới');
            $table->unique('nsx_ten');
            $table->softDeletes()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nha_san_xuats');
    }
}
