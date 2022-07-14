<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\NhaSanXuat;

use App\Models\LoaiSanPham;

use Illuminate\Support\Facades\DB;

class NhaSanXuatSeeder extends Seeder
{
    protected $model = NhaSanXuat::class;


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NhaSanXuat::factory()->count(50)->create();

        $lsp = LoaiSanPham::all();
        NhaSanXuat::all()->each(function ($nsx) use ($lsp)
        {

            // $rand_number = rand(0,count($data));
            $nsx->loaiSanPham()->attach(
                rand(0,50)
            );
        });
    }
}
