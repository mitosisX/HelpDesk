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
        // foreach (range(0, 5) as $loop) {
        //     DB::table('users')
        //         ->insert([
        //             'name' => fake()->name(),
        //             'email' => fake()->email(),
        //             'password' => bcrypt('password'),
        //             'role_id' => fake()->numberBetween(1, 2)
        //         ]);
        // }

        DB::table('users')
                ->insert([
                    'name' =>'Admin',
                    'email' => 'admin@he.lp',
                    'password' => bcrypt('password'),
                    'role_id' => 1
                ]);

            DB::table('users')
            ->insert([
                'name' => 'IT Staff',
                'email' => 'staff@he.lp',
                'password' => bcrypt('password'),
                'role_id' => 2
            ]);

            DB::table('users')
            ->insert([
                'name' => 'NRWB User',
                'email' => 'user@he.lp',
                'password' => bcrypt('password'),
                'role_id' => 3
            ]);

            DB::table('users')
            ->insert([
                'name' => 'Manager',
                'email' => 'manager@he.lp',
                'password' => bcrypt('password'),
                'role_id' => 4
            ]);
    }
}