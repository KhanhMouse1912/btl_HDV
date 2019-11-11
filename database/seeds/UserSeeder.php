<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->insert([
    		"name"=>"Tuan",
    		"email"=>"tuantan@gmail.com",
    		"password"=>bcrypt("123"),
    		"role"=>"user",
    	]);

    	DB::table('users')->insert([
    		"name"=>"Khanh",
            "email"=>"khanhnc@gmail.com",
            "password"=>bcrypt("123"),
            "role"=>"user",
    	]);

    	DB::table('users')->insert([
    		"name"=>"Duc",
            "email"=>"ducvq@gmail.com",
            "password"=>bcrypt("123"),
            "role"=>"user",
    	]);
        // $this->call(UsersTableSeeder::class);
    }
}
