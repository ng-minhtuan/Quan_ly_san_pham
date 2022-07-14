<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

            $gender = $this->faker->randomElement(['Nam','Nữ']);
        return [
            'fullname' =>$this-> faker->name($gender),
            'email' => $this->faker->safeEmail,
            'username' => $this->faker->userName,
            'image'=>$this->faker->imageUrl(640,480,true),
            'gender' => $this->faker->randomElement(['Nam', 'Nữ']),
            'birthdate'=> $this->faker->dateTimeBetween('1950-01-01', '2012-12-31')->format('d/m/Y'),
            'remember_token'=> Str::random(32),
            'confirm_code'=> time().uniqid(true),
            'role'=>'guest',
            'password' => Hash::make('Guest@123'),
            'created_at'=>$this->faker->dateTimeBetween('-2 years','now','Asia/Ho_Chi_Minh'),
            'updated_at'=>$this->faker->dateTimeBetween('-1 years','now','Asia/Ho_Chi_Minh'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
