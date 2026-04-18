<?php

namespace Database\Seeders;

use App\Models\SiteAssignments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SiteAssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SiteAssignments::create([
            'employee_id' => 1,
            'site_id' => 1,
            'is_leader' => true,
            'start_date' => now()->subDays(10),
            'end_date' => now()->addMonths(1),
        ]);

        SiteAssignments::create([
            'employee_id' => 1,
            'site_id' => 2,
            'is_leader' => false,
            'start_date' => now()->subDays(5),
            'end_date' => now()->addMonths(2),
        ]);
    }
}
