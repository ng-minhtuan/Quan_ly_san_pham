<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\LoaiSanPham;
use League\CommonMark\Reference\Reference;

class CreateLoaiSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loai_san_phams', function (Blueprint $table) {
            $table->id('lsp_id')->comment('Khoá chính của sản phẩm');
            $table->string('lsp_ten')->comment('Tên loại sản phẩm');
            $table->text('lsp_ghichu')->comment('Ghi chú cho từng danh mục loại sản phẩm');
            $table->string('lsp_slug')->unique();
            $table->foreignId('lsp_parent_id')->nullable()
            ->references('lsp_id')
            ->on('loai_san_phams')
            ->constrained()
            ->cascadeOnUpdate()
            ->onDelete('set null')
            ->comment('Quan hệ giữa các loại sản phẩm');
            $table->timestamp('lsp_taomoi')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày tạo mới loại sản phẩm');
            $table->timestamp('lsp_capnhat')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày cập nhật loại sản phẩm');
            $table->unique('lsp_ten');
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
        Schema::dropIfExists('loai_san_phams');
    }
}
