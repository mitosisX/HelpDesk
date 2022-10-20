<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(0, 5) as $loop) {
            DB::table('users')
                ->insert([
                    'name' => fake()->name(),
                    'email' => fake()->email(),
                    'password' => bcrypt(fake()->password()),
                    'role_id' => 2
                ]);
        }
    }
}
