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
                "QA\n" .
                "Good day,\n " .
                "My name is Stephen E. Espeño. I am a recent graduate with  full-stack development experience, seeking to begin my career in Quality Assurance. I am eager to apply my analytical skills and attention to detail to ensure the delivery of high-quality software\n\n" .

                "Developer:\n" .
                "Good day,\n" .
                "My name is Stephen E. Espeño. I am a recent graduate with 3 months of full-stack development experience, seeking to contribute to a development team while further enhancing my programming skills and technical expertise.\n\n" .

                "Network Engineer:\n" .
                "Good day,\n" .
                "My name is Stephen E. Espeño. I am a recent graduate with technical experience, seeking to start my career in network engineering. I am eager to apply my problem-solving skills and technical knowledge while continuing to learn in a professional environment.",

            'created_at'    => now(),
            'updated_at'    => now(),
        ]);
    }
}
