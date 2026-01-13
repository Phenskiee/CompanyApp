<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Dropdown;

class OptionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dropdowns')->delete();

        Dropdown::insert([
            [
                'option_name' => "All Status", 
                'order' => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'option_name' => "Viewed", 
                'order' => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'option_name' => "Pending", 
                'order' => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'option_name' => "For Interview", 
                'order' => 4,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'option_name' => "Rejected", 
                'order' => 5,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'option_name' => "After Interview (Pending)",
                'order' => 6,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'option_name' => "After Interview (Rejected)",
                'order' => 7,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'option_name' => "Job Offer", 
                'order' => 8,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
