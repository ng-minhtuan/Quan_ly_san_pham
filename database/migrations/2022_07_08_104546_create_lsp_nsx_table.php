<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLspNsxTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lsp_nsx', function (Blueprint $table) {
            $table->bigIncrements('id')->comment('Khoá chính của bảng Pivot lsp_nsx');
            $table->foreignId('nsx_id')
            ->references('nsx_id')
            ->on('nha_san_xuats')
            ->constrained('nha_san_xuats')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->comment('Khoá ngoài chiếu đến bảng Nhà sản xuất');
            $table->foreignId('lsp_id')
            ->references('lsp_id')
            ->on('loai_san_phams')
            ->constrained('loai_san_phams')
            ->onUpdate('cascade')
            ->onDelete('cascade')
            ->comment('Khoá ngoài chiếu đến bảng Loại sản phẩm');
            $table->timestamps();
            $table->unique(['lsp_id','nsx_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lsp_nsx');
    }
}
