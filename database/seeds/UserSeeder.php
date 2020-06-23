<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	return DB::table('users')
    				->insert([
    					'name' => 'admin',
    					'email' => 'admin@admin.com',
    					'password' => Hash::make('123456')
    			]);
    }


}
