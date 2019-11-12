<?php

use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker::create();

        for($i = 1;$i <= 8;$i++) {
        	DB::table('posts')->insert([
        		'title' => "Title ".$i,
        		'text' => $faker->text,
        		'user_id' => $i,
        		'viewer' => rand(0, 10),
        	]);
        }
    }
}
