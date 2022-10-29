<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentsSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Human Resource', 'IT', 'Cleaning', 'Accounts'] as $dep) {
            DB::table('departments')
                ->insert([
                    'name' => $dep
                ]);
        }
    }
}
