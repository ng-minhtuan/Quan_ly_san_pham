<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class TinTucFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = new User();
        $userId = $user->pluck('user_id')->toArray();


        return [
            'tintuc_tieude' => $this->faker->sentence,
            'tintuc_tomtat' =>$this->faker->paragraph(rand(2,4)),
            'tintuc_noidung' => $this->faker->paragraph(rand(10,20)),
            'tintuc_trangthai'=> (bool)rand(0,1),
            'tintuc_taomoi'=>$this->faker->dateTimeBetween('-2 years','now','Asia/Ho_Chi_Minh'),
            'tintuc_capnhat'=>$this->faker->dateTimeBetween('-1 years','now','Asia/Ho_Chi_Minh'),
            'user_id'=> $this->faker->randomElement($userId),
        ];
    }
}
