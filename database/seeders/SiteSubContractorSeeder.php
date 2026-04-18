<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSubContractorSeeder extends Seeder
{
    public function run(): void
    {
        $siteIds = [2, 3, 4, 5, 6, 7, 8, 9];

        $assignments = [
            1 => [2, 5, 8],
            2 => [3, 6, 9],
            3 => [4, 7, 2],
            4 => [5, 8, 3],
            5 => [6, 9, 4],
        ];

        $rows = [];

        foreach ($assignments as $subcontractorId => $sites) {
            foreach ($sites as $siteId) {
                $rows[] = [
                    'site_id' => $siteId,
                    'subcontractor_id' => $subcontractorId,
                    'contract_type' => rand(0, 1)
                        ? 'QUASI_DELEGATION'
                        : 'FIXED_PRICE',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        shuffle($rows);

        DB::table('site_subcontractors')->insert($rows);
    }
}
