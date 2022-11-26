<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\CancelReason;
use App\Models\CarCategory;
use App\Models\Link;
use App\Models\Modell;
use App\Models\ModellYear;
use App\Models\Page;
use App\Models\Provider;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Admin
        if (!Admin::find(1)) {
            Admin::updateOrCreate([
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '123456',
                'phone' => '123456',
            ]);
        }

//users table
        if (!User::find(1)) {
            User::updateOrCreate([
                'id' => 1,
                'name' => 'user',
                'email' => 'user@gmail.com',
                'password' => '123456',
                'country_code' => '+20',
                'phone' => '1094641332',
                'user_phone' => '+201094641332',
            ]);
        }

        //providers table
        if (!Provider::find(1)) {
            Provider::updateOrCreate([
                'id' => 1,
                'name' => 'provider',
                'email' => 'provider@gmail.com',
                'password' => '123456',
                'country_code' => '+20',
                'phone' => '1111651415',
                'user_phone' => '+201111651415',
            ]);
        }
        $data = [
            [
                'title_ar' => 'الشروط والاحكام',
                'title_en' => 'terms and conditions',
                'body_ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع انترنت',
                'body_en' => 'Lorem Ipsum is a virtual model that is placed in the designs to be presented to the client to imagine the way to put texts in the designs, whether they are printed designs ... a brochure or flyer for example ... or models for websites',
                'image' => '1.png',
                'icon' => 'fa fa-user',
            ],
            [
                'title_ar' => 'سياسة الخصوصية',
                'title_en' => 'privacy policy',
                'body_ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع انترنت',
                'body_en' => 'Lorem Ipsum is a virtual model that is placed in the designs to be presented to the client to imagine the way to put texts in the designs, whether they are printed designs ... a brochure or flyer for example ... or models for websites',
                'image' => '2.png',
                'icon' => 'fa fa-user',
            ],
            [
                'title_ar' => 'عن التطبيق',
                'title_en' => 'about application',
                'body_ar' => 'لوريم ايبسوم هو نموذج افتراضي يوضع في التصاميم لتعرض على العميل ليتصور طريقه وضع النصوص بالتصاميم سواء كانت تصاميم مطبوعه … بروشور او فلاير على سبيل المثال … او نماذج مواقع انترنت',
                'body_en' => 'Lorem Ipsum is a virtual model that is placed in the designs to be presented to the client to imagine the way to put texts in the designs, whether they are printed designs ... a brochure or flyer for example ... or models for websites',
                'image' => '3.png',
                'icon' => 'fa fa-user',
            ],

        ];
        foreach ($data as $get) {
            Page::updateOrCreate($get);
        }

        $car_category_data = [
            [
                'title_ar' => 'سيارات شعبية',
                'title_en' => 'local cars',

            ],
            [
                'title_ar' => 'سيارات متوسطه',
                'title_en' => 'Average cars',

            ],
            [
                'title_ar' => 'سيارات فارهه',
                'title_en' => 'Luxury cars',
            ],
            [
                'title_ar' => 'دراجه نارية',
                'title_en' => 'Motorcycle',
            ],

        ];
        foreach ($car_category_data as $get) {
            CarCategory::updateOrCreate($get);
        }

        $brands_data = [
            [
                'title_ar' => 'BMW',
                'title_en' => 'BMW',

            ],
            [
                'title_ar' => 'هيونداي',
                'title_en' => 'hundai',

            ],
            [
                'title_ar' => 'فيات',
                'title_en' => 'fiat',
            ],
            [
                'title_ar' => 'لانسر',
                'title_en' => 'lansaer',
            ],

        ];
        foreach ($brands_data as $get) {
            $brand = Brand::updateOrCreate($get);
            if ($brand) {
                $modells = [
                    [
                        'title_ar' => '1651',
                        'title_en' => '1651',
                        'brand_id' => $brand->id,
                    ],
                    [
                        'title_ar' => '2581',
                        'title_en' => '2581',
                        'brand_id' => $brand->id,
                    ],
                ];
                foreach ($modells as $row) {
                    $modell = Modell::updateOrCreate($row);

                    if ($modell) {
                        $years = [
                            [
                                'year' => '2020',

                                'modell_id' => $modell->id,
                            ],
                            [
                                'year' => '2022',
                                'modell_id' => $modell->id,
                            ],
                        ];
                        foreach ($years as $year_row) {
                            ModellYear::updateOrCreate($year_row);
                        }
                    }
                }
            }
        }
//        cancel_reasons
        $cancel_reasons_data = [
            [
                'title_ar' => 'رجل الصيانة تأخر جدا',
                'title_en' => 'provider is too late',
                'type' => 'user_orders',
            ],
            [
                'title_ar' => 'لقد تم اصلاح العطل',
                'title_en' => 'i fix the problem',
                'type' => 'user_orders',
            ],
            [
                'title_ar' => 'قله تكلفة التصليح',
                'title_en' => 'Less repair cost',
                'type' => 'provider_orders',
            ],
            [
                'title_ar' => '2قله تكلفة التصليح',
                'title_en' => 'Less repair cost2',
                'type' => 'provider_orders',
            ],
            [
                'title_ar' => '3قله تكلفة التصليح',
                'title_en' => 'Less repair cost3',
                'type' => 'provider_orders',
            ],
            [
                'title_ar' => 'قله تكلفة التصليح4',
                'title_en' => 'Less repair cost4',
                'type' => 'provider_orders',
            ],
            [
                'title_ar' => '5قله تكلفة التصليح',
                'title_en' => 'Less repair cost3',
                'type' => 'user_extra_services',
            ],
            [
                'title_ar' => 'قله تكلفة التصليح6',
                'title_en' => 'Less repair cost4',
                'type' => 'user_extra_services',
            ],

        ];
        foreach ($cancel_reasons_data as $row) {
            CancelReason::updateOrCreate($row);
        }

//links table
        $data = [
            [
                'link' => 'https://ar-ar.facebook.com/',
                'image' => 'facebook.png',
                'name' => 'facebook',
            ],
            [
                'link' => 'https://api.whatsapp.com/01201636129',
                'image' => 'whats_app.png',
                'name' => 'whats_app',
            ],
            [
                'link' => 'https://www.youtube.com/',
                'image' => 'youtube.png',
                'name' => 'youtube',
            ],

        ];
        foreach ($data as $get) {
            Link::updateOrCreate($get);
        }
    }
}
