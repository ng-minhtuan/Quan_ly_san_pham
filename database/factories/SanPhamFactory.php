<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LoaiSanPham;
use App\Models\NhaSanXuat;

class SanPhamFactory extends Factory
{



    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lsp = new LoaiSanPham;
        $lspId = $lsp->where('lsp_parent_id','!=','NULL')->pluck('lsp_id')->toArray();

        $nsx = new NhaSanXuat;
        $nsxId = $nsx->pluck('nsx_id')->toArray();
        return [
            'sp_ten'=> $this->faker->name(),
            'sp_gia'=> random_int(10,1000)*1000,
            'sp_hinhanh'=>$this->faker->imageUrl(400,300,null,true),
            'sp_thongtin'=>$this->faker->paragraph(rand(10,20)),
            'sp_taomoi'=>$this->faker->dateTimeBetween('-2 years','now','Asia/Ho_Chi_Minh'),
            'sp_capnhat'=>$this->faker->dateTimeBetween('-1 years','now','Asia/Ho_Chi_Minh'),
            'lsp_id'=>$this->faker->randomElement($lspId),
            'nsx_id'=>$this->faker->randomElement($nsxId),
        ];
    }
}
