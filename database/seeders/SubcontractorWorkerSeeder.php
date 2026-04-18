<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubcontractorWorkerSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('subcontractor_workers')->insert([
            [
                'subcontractor_id' => 1,
                'name' => 'Takashi Tanaka',
                'name_kana' => 'タカシ タナカ',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcontractor_id' => 1,
                'name' => 'Kenta Suzuki',
                'name_kana' => 'ケンタ スズキ',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcontractor_id' => 2,
                'name' => 'Yuta Sato',
                'name_kana' => 'ユウタ サトウ',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcontractor_id' => 2,
                'name' => 'Daichi Nakamura',
                'name_kana' => 'ダイチ ナカムラ',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcontractor_id' => 3,
                'name' => 'Shota Yamamoto',
                'name_kana' => 'ショウタ ヤマモト',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcontractor_id' => 3,
                'name' => 'Ren Kobayashi',
                'name_kana' => 'レン コバヤシ',
                'status' => 'INACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcontractor_id' => 5,
                'name' => 'Haruto Ito',
                'name_kana' => 'ハルト イトウ',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'subcontractor_id' => 5,
                'name' => 'Sora Fujimoto',
                'name_kana' => 'ソラ フジモト',
                'status' => 'ACTIVE',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
