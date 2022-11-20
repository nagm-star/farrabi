<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'name' => 'كلية الفارابي للعلوم والتقانة',
            'name_en' => 'Farabi College For Science and Technology',

            'key' => 'كلية , الفارابي ',

            'key_en' => 'farabi, collage',

            'description' => 'كلية الفارابي للعلوم والتقانة',
            
            'description_en' => 'Farabi College for Science & Technology',

            'address' => 'Sudan, khartoum',
            
            'image' => 'favicon.png',

            'contact_number' => '249 99183323',

            'email' => 'info@passport.gov.sd.com',

            'facebook' => '#',

            'twitter' => '#',

            'youtube' => '#',
        ]);
    }
}
