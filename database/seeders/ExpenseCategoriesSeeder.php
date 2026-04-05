<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExpenseCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'category_name' => 'Ad-hoc Transport',
                'description' => 'Expenses related to ad-hoc transport',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Transportation',
                'description' => 'Regular transportation expenses',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Meals',
                'description' => 'Meal related expenses',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Supplies',
                'description' => 'Office or project supplies',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_name' => 'Entertainment',
                'description' => 'Client entertainment or events',
                'status' => 'INACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('expense_categories')->insert($categories);
    }
}
