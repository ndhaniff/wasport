<?php

use Illuminate\Database\Seeder;

class MedalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('medals')->insert([
        'name' => 'Medal 1',
        'medal_grey' => 'medal_1.png',
        'medal_color' => 'medal_2.png',
        'cert' => '',
        'bib' => '',
        'races_id' => 1,
      ]);

      DB::table('medals')->insert([
        'name' => 'Medal 2',
        'medal_grey' => 'medal_3.png',
        'medal_color' => 'medal_4.png',
        'cert' => '',
        'bib' => '',
        'races_id' => 2,
      ]);

      DB::table('medals')->insert([
        'name' => 'Medal 3',
        'medal_grey' => 'medal_5.png',
        'medal_color' => 'medal_6.png',
        'cert' => '',
        'bib' => '',
        'races_id' => 3,
      ]);
    }
}
