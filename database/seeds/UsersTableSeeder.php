<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        DB::table('users')->insert([
            'id'=>1,
            'name'=>'Developer',
            'email'=>'dev@dev.loc',
            'password'=>Hash::make('123456'),
            'admin' => 1,
            'created_at'=>$now,
            'updated_at'=>$now,
        ]);
    }
}
