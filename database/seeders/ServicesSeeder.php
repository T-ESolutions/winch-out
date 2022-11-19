<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'title_ar' => 'تغيير كاوتش',
                'title_en' => 'change tires',
                'image' => '1.png',
                'price' => 100,
            ],
            [
                'title_ar' => 'نقل العربة بالونش',
                'title_en' => 'Transporting the trolley with a winch',
                'image' => '1.png',
                'price' => 100,
            ],
            [
                'title_ar' => 'تغيير الزجاج',
                'title_en' => 'change the glass',
                'image' => '1.png',
                'price' => 100,
            ],
            [
                'title_ar' => 'تغيير كاوتش',
                'title_en' => 'change tires',
                'image' => '1.png',
                'price' => 100,
            ],


        ];
        foreach ($data as $get) {
            Service::updateOrCreate($get);
        }
    }
}
