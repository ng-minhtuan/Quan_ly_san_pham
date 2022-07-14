<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\LoaiSanPham;

use Illuminate\Support\Str;
class LoaiSanPhamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lsp = LoaiSanPham::pluck('lsp_id')->toarray();
        $ten_loai_sp = $this->faker->name();
        return [
            'lsp_ten'=> $ten_loai_sp,
            'lsp_ghichu'=> $this->faker->paragraph(rand(2,4)),
            'lsp_slug'=> Str::slug($ten_loai_sp),
            'lsp_parent_id'=> $this->faker->randomElement($lsp),
            'lsp_taomoi'=>$this->faker->dateTimeBetween('-2 years','now','Asia/Ho_Chi_Minh'),
            'lsp_capnhat'=> $this->faker->dateTimeBetween('-1 years','now','Asia/Ho_Chi_Minh'),
        ];
    }
}
