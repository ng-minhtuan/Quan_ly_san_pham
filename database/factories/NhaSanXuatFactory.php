<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class NhaSanXuatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'nsx_ten'=> $this->faker->name(),
            'nsx_mota'=> $this->faker->paragraph(rand(10,20)),
            'nsx_taomoi'=> $this->faker->dateTimeBetween('-2 years', 'now','Asia/Ho_Chi_Minh'),
            'nsx_capnhat'=>$this->faker->dateTimeBetween('-1 years','now','Asia/Ho_Chi_Minh'),
            'nsx_hinhanh'=> $this->faker->imageUrl(640,480,true),
        ];
    }
}
