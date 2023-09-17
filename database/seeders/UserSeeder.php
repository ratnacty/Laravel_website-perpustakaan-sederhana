<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for($i=0; $i<3; $i++){
           User::create([
                'name'=>$faker->name,
                'email'=>$faker->unique()->email,
                'password'=>bcrypt('password'),
                'level'=>'admin',
                'remember_token' => Str::random(60),
            ]);
        }
    }
}
