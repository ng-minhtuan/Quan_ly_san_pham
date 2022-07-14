<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Run the database seeds.
         *
         * @return void
         */
        /**
         * Tạo trường Admin
         */

        $admin = new User();
        $admin->fullname = 'Admin';
        $admin->username = 'Admin12345';
        $admin->email = 'admin@example.com';
        $admin->image = "public/storage/images/01-13-06-07-2022-guesttest-trend-avatar-1.jpg";
        $admin->gender = 'Nam';
        $admin->confirm_code = time().'-01-'.uniqid(true);
        $admin->confirmed = 1;
        $admin->email_verified_at = date('Y-m-d H:i:s');
        $admin->birthdate = '28/12/1995';
        $admin->role = 'admin';
        $admin->password = Hash::make('Admin@123456');
        $admin->save();

        /**
         * Tạo trường User Guests
         */
        User::factory()->count(50)->create();


    }
}
