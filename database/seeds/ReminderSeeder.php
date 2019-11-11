<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReminderSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('reminders')->insert([
    		"id"=>"123",
    		"kindOfRelationship"=>"01",
    		"name"=>"Tuan",
    		"phoneNumber"=>"0977901108",
    		"time"=>"2019-10-07",
    		"place"=>"DHCNHN",
    		"reason"=>"learning",
    	]);

    	DB::table('reminders')->insert([
    		"id"=>"321",
    		"kindOfRelationship"=>"02",
    		"name"=>"Thinh",
    		"phoneNumber"=>"0977901108",
    		"time"=>"2019-10-07",
    		"place"=>"DHQGHN",
    		"reason"=>"learning",
    	]);

    	DB::table('reminders')->insert([
    		"id"=>"213",
    		"kindOfRelationship"=>"03",
    		"name"=>"Trang",
    		"phoneNumber"=>"0977901108",
    		"time"=>"2019-10-07",
    		"place"=>"DHCN",
    		"reason"=>"learning",
    	]);
        // $this->call(UsersTableSeeder::class);
    }
}
