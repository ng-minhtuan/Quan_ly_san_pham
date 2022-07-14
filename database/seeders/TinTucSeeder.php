<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TinTuc;
class TinTucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tintuc::factory()->count(50)->create();
    }
}
