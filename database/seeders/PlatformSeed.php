<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Platform;

class PlatformSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('platforms')->delete();

        Platform::insert([
            [
                'platform_name' => 'Facebook',
                'order' => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'platform_name' => 'LinkedIn',
                'order' => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'platform_name' => 'Jobstreet',
                'order' => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'platform_name' => 'Indeed Philippines',
                'order' => 4,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'platform_name' => 'BoosJobs',
                'order' => 5,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'platform_name' => 'Direct Site',
                'order' => 6,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'platform_name' => 'Others',
                'order' => 7,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
