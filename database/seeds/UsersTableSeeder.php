<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'username' => 'user01', 'password' => '1234', 'name' => 'Phương Tuấn', 'isOnline' => 0, 'created_at' => '2020-03-27 07:11:41', 'updated_at' => '2020-03-27 07:11:41'],
            ['id' => 2, 'username' => 'user02', 'password' => '1234', 'name' => 'Bảo Khánh', 'isOnline' => 0, 'created_at' => '2020-03-27 07:11:41', 'updated_at' => '2020-03-27 07:11:41'],
            ['id' => 3, 'username' => 'user03', 'password' => '1234', 'name' => 'Sơn Tùng', 'isOnline' => 0, 'created_at' => '2020-03-27 07:11:41', 'updated_at' => '2020-03-27 07:11:41']
        ];
        DB::table('users')->insert($data);
    }
}
