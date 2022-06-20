<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('pages')->insert([
            'id'=>1,
            'url'=>'home',
            'title'=>json_encode(['hy'=>'Գլխավոր', 'ru'=>'Главная', 'en'=>'Home'], JSON_UNESCAPED_UNICODE),
            'static'=>'home',
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);
    }
}
