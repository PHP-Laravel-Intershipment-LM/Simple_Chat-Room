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
            ['id' => 1, 'id_room' => 1, 'id_user' => 1],
            ['id' => 2, 'id_room' => 1, 'id_user' => 2],
            ['id' => 3, 'id_room' => 1, 'id_user' => 3]
        ];
        DB::table('actives')->insert($data);
    }
}
