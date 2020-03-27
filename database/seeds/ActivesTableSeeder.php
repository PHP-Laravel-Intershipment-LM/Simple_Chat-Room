<?php

use Illuminate\Database\Seeder;

class ActivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'id_room' => 1, 'id_user' => 1, 'created_at' => '2020-03-27 07:11:41', 'updated_at' => '2020-03-27 07:11:41'],
            ['id' => 2, 'id_room' => 1, 'id_user' => 2, 'created_at' => '2020-03-27 07:11:41', 'updated_at' => '2020-03-27 07:11:41'],
            ['id' => 3, 'id_room' => 1, 'id_user' => 3, 'created_at' => '2020-03-27 07:11:41', 'updated_at' => '2020-03-27 07:11:41']
        ];
        DB::table('actives')->insert($data);
    }
}
