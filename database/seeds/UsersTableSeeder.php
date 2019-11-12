<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for($i = 0;$i < 10;$i++) {
        	DB::table('users')->insert([
        		'name' => $faker->name,
		        'email' => $faker->unique()->safeEmail,
		        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
		        'position' => 'author',
		        'is_active' => 1,
		        'remember_token' => Str::random(10),
        	]);
        }
    }
}
