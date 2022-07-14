<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->bigIncrements('sp_id')->comment('Khoá chính của sản phẩm');
            $table->string('sp_ten',200)->comment('Tên sản phẩm');
            $table->unsignedInteger('sp_gia')->default(0)->comment('Giá sản phẩm');
            $table->string('sp_hinhanh',200)->comment('Ảnh sản phẩm');
            $table->text('sp_thongtin')->comment('Thông tin sản phẩm');
            $table->timestamp('sp_taomoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian tạo sản phẩm mới');
            $table->timestamp('sp_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời gian cập nhập sản phẩm');
            $table->foreignId('nsx_id')
            ->references('nsx_id')
            ->on('nha_san_xuats')
            ->constrained('nha_san_xuats')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->comment('Khoá ngoài: Id nhà sản xuất');
            $table->foreignId('lsp_id')
            ->references('lsp_id')
            ->on('loai_san_phams')
            ->constrained('loai_san_phams')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->comment('Khoá ngoài: Id loại sản phẩm');
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
        Schema::dropIfExists('san_phams');
    }
}
