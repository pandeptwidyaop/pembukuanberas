<?php

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
        DB::table('users')->insert([
          'name' => 'Admin',
          'username' => 'admin',
          'password' => '$2y$10$rs/omNlXiE2GdfilH65l/OlpAbzYgqKZBdxjGs9zMroaajMsYOary'
        ]);
    }
}
