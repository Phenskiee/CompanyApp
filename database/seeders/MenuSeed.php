<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Menus;

class MenuSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menuses')->truncate();

        Menus::insert([
            [
                'nav_name'      => 'Dashboard',
                'route_name'    => 'dashboard',
                'icon'          => 'fa-solid fa-house',
                'order'         => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nav_name'      => 'Companies',
                'route_name'    => 'companies',
                'icon'          => 'fa-solid fa-building',
                'order'         => 2,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nav_name'      => 'Responses',
                'route_name'    => 'responses',
                'icon'          => 'fa-solid fa-file',
                'order'         => 3,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nav_name'      => 'Accounts',
                'route_name'    => 'accounts',
                'icon'          => 'fa-solid fa-id-card',
                'order'         => 4,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
