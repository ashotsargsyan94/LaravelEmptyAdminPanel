<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            [
                'id'=>1,
                'iso'=>'hy',
                'title'=>'Հայերեն',
            ],
            [
                'id'=>2,
                'iso'=>'ru',
                'title'=>'Русский',
            ],
            [
                'id'=>3,
                'iso'=>'en',
                'title'=>'English',
            ],
        ]);
    }
}
