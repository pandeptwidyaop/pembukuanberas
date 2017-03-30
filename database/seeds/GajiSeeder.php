<?php

use Illuminate\Database\Seeder;

class GajiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('gajis')->insert([
          'id' => 1,
          'gaji' => 9000
        ]);
    }
}
