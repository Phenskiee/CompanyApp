<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Account;

class AccountSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('accounts')->truncate();

        Account::insert([
            [
                'company_site' => "Company 1",
                'email_use' => 'company1@example.com',
                'password' => 'password1',
                'links' => 'company1.com',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'company_site' => "Company 2",
                'email_use' => 'company2@example.com',
                'password' => 'password2',
                'links' => 'company2.com',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}
