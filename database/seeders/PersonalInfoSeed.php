<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PersonalInfo;

class PersonalInfoSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('personal_infos')->delete();

        PersonalInfo::insert([
            'name' => 'Stephen E. Espeño',
            'email' => 'stephenespeno97@gmail.com',
            'phone_number' => '0927-516-5347',
            'address' => '777 Mercado St. Tondo Manila',
            'portfolio' => 'https://phenskiee.vercel.app/',
            'introduction' => 
                "I am writing to express my interest in the Programming position at [Company Name]. As a recent graduate with a degree in Information Technolog, I have developed a solid foundation in software and web development. My academic background and project experience have equipped me with practical skills in PHP, JavaScript, Python, MySQL, MSSQL, and the Laravel framework. I am eager to apply my knowledge in a professional setting and contribute meaningfully to your development team while continuing to grow as a programmer.",

            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
}
