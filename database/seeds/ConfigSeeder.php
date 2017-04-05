<?php

use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configs')->insert([
          'title' => 'UD. KEMBANG MERTHA',
          'owner' => 'KETUT TEKES',
          'telephone' => '0987654321',
          'address' => 'JALAN RAYA CELUK SUKAWATI GIANYAR'
        ]);
    }
}
