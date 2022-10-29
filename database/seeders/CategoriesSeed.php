<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (['Network', 'Internet', 'Hardware'] as $category) {
            DB::table('categories')
                ->insert([
                    'name' => $category
                ]);
        }
    }
}
