<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
         * Array of admins.
         */

        $users = [
            [
                'name' => 'علی',
                'email' => 'ali@salimi.ir',
                'mobile' => '09100000000',
                'password' => bcrypt('ali123456'),
            ],
            [
                'name' => 'مهدی',
                'email' => 'mahdi@rahimi.com',
                'mobile' => '09101111111',
                'password' => bcrypt('mahdi123456'),
            ]
        ];

        /**
         * Create admin and assign role.
         */

        foreach ($users as $key => $user) {

            if ($key === 0) {
                // user
                User::create($user);

            }

            if ($key === 1) {
                // admin
                User::create($user);

            }
        }
    }
}
