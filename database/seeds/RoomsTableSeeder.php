<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Public Room', 'created_at' => '2020-03-27 07:11:41', 'updated_at' => '2020-03-27 07:11:41'],
        ];
        DB::table('rooms')->insert($data);
    }
}
