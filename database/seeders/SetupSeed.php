<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Setup;

class SetupSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('setups')->delete();

        Setup::insert([
            [
                'setup_name' => 'Work from Home',
                'order' => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'setup_name' => 'Hybrid',
                'order' => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'setup_name' => 'Onsite',
                'order' => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
