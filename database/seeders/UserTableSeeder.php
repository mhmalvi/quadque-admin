<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'quadque', 'email' => 'admin@quadque.com', 'password' => bcrypt('admin@quadque.com'), 'user_type' => 1, 'phone' => '01749240901'],
            ['name' => 'Jubaer', 'email' => 'shere1895@gmail.com', 'password' => bcrypt('shere1895@gmail.com'), 'user_type' => 3, 'phone' => '01749240901'],
            ['name' => 'Shere Ali', 'email' => 'eng.shereali@gmail.com', 'password' => bcrypt('eng.shereali@gmail.com'), 'user_type' => 3, 'phone' => '01749240901'],
        ];

        User::insert($data);

    }
}
