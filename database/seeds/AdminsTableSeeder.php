<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
              'name' => 'ndhaniff',
              'email' => 'admin@admin.com',
              'password' => bcrypt('admin123'),
        ]);

        DB::table('admins')->insert([
              'name' => 'sanz',
              'email' => 'xsaintzx@gmail.com',
              'password' => bcrypt('admin123'),
        ]);
    }
}
