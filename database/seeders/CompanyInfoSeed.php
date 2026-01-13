<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CompanyInfo;
use App\Models\Platform;
use App\Models\Setup;


class CompanyInfoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_infos')->delete();

        $platforms = Platform::pluck('id', 'platform_name')->toArray();
        $setups = Setup::pluck('id', 'setup_name')->toArray();

        CompanyInfo::insert([
            [
                'company_name' => "Apply4U | Job search & Recruitment Platform",
                'position' => "pos1",
                'email' => 'company1@example.com',
                'salary' => 500,
                'platform_id' => $platforms['Facebook'] ?? null,
                'setup_id' => $setups['Hybrid'] ?? null,
                'location' => 'Manila',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'company_name' => "Cambridge University Press & Assessment | Manila",
                'position' => "pos2",
                'email' => 'company2@example.com',
                'salary' => 500,
                'platform_id' => $platforms['Facebook'] ?? null,
                'setup_id' => $setups['Hybrid'] ?? null,
                'location' => 'Manila',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'company_name' => "Company 22",
                'position' => "pos22",
                'email' => 'company2@example.com',
                'salary' => 500,
                'platform_id' => $platforms['Facebook'] ?? null,
                'setup_id' => $setups['Hybrid'] ?? null,
                'location' => 'Manila',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
