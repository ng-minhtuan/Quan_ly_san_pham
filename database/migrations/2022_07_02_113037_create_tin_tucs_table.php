<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTinTucsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tin_tucs', function (Blueprint $table) {
            $table->id('tintuc_id')->comment('Khoá chính ID Tin tức');
            $table->string('tintuc_tieude')->comment('Tiêu đề');
            $table->text('tintuc_tomtat')->comment('Tóm tắt nội dung');
            $table->longtext('tintuc_noidung')->comment('Nội dung');

            $table->timestamp('tintuc_taomoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời diểm tạo mới');
            $table->timestamp('tintuc_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm cập nhật');
            $table->boolean('tintuc_trangthai')->default(false)->comment('Trạng thái công khai');
            $table->foreignId('user_id')
            ->references('user_id')
            ->on('users')
            ->constrained('users')
            ->onUpdate('cascade')
            ->onDelete('cascade')->comment('Khoá ngoài chỉ đến User đăng bài');
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
        Schema::dropIfExists('tin_tucs');
    }
}
