<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\LoaiSanPham;

use Illuminate\Support\Str;

class LoaiSanPhamSeeder extends Seeder
{
    protected $model = LoaiSanPham::class;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lsp1 = new LoaiSanPham();
        $lsp1->lsp_ten = 'Loại sản phẩm 1';
        $lsp1->lsp_ghichu = 'Đây là loại sản phẩm 1';
        $lsp1->lsp_slug = Str::slug($lsp1->lsp_ten);
        $lsp1->save();

        $lsp2 = new LoaiSanPham();
        $lsp2->lsp_ten = 'Loại sản phẩm 2';
        $lsp2->lsp_ghichu = 'Đây là loại sản phẩm 2';
        $lsp2->lsp_slug = Str::slug($lsp2->lsp_ten);
        $lsp2->save();

        $lsp3 = new LoaiSanPham();
        $lsp3->lsp_ten = 'Loại sản phẩm 3';
        $lsp3->lsp_ghichu = 'Đây là loại sản phẩm 3';
        $lsp3->lsp_slug = Str::slug($lsp3->lsp_ten);
        $lsp3->save();


        $lsp4 = new LoaiSanPham();
        $lsp4->lsp_ten = 'Loại sản phẩm 4';
        $lsp4->lsp_ghichu = 'Đây là loại sản phẩm 4';
        $lsp4->lsp_slug = Str::slug($lsp4->lsp_ten);
        $lsp4->save();


        LoaiSanPham::factory()->count(50)->create();

    }
}
