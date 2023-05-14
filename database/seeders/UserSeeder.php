<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => "Jason Rudland",
            'email' => "jason@jasonrudland.co.uk",
            'password' => md5("password"),
        ]);

        $faker = Factory::create();
        for ($i = 1; $i <= 4; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => md5($faker->password),
            ]);
        }
    }
}
