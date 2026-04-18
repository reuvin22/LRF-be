<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        DB::table('construction_sites')->insert([
            [
                'site_code' => 'SIT-001',
                'site_name' => 'Site A - Shinjuku Tower',
                'client_name' => 'ABC Construction Co.',
                'contract_type' => 'QUASI_DELEGATION',
                'address' => '1-1-1 Nishi-Shinjuku, Tokyo, Japan',
                'status' => 'PREPARING',
                'start_date' => '2026-04-01',
                'end_date' => '2026-12-31',
                'contract_amount' => null,
                'dotto_genka_code' => 'DG-001',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'site_code' => 'SIT-002',
                'site_name' => 'Site B - Shibuya Office',
                'client_name' => 'XYZ Builders Inc.',
                'contract_type' => 'FIXED_PRICE',
                'address' => '2-2-2 Shibuya, Tokyo, Japan',
                'status' => 'IN_PROGRESS',
                'start_date' => '2025-09-01',
                'end_date' => '2026-08-31',
                'contract_amount' => 120000000,
                'dotto_genka_code' => 'DG-002',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'site_code' => 'SIT-003',
                'site_name' => 'Site C - Roppongi Hills',
                'client_name' => 'LMN General Contractors',
                'contract_type' => 'FIXED_PRICE',
                'address' => '3-3-3 Roppongi, Tokyo, Japan',
                'status' => 'COMPLETED',
                'start_date' => '2024-01-15',
                'end_date' => '2025-12-15',
                'contract_amount' => 95000000,
                'dotto_genka_code' => 'DG-003',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
