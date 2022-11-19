<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = Service::active()->first();
        if ($service) {
            $data = [
                [
                    'title_ar' => 'اختر نوع الموقع من فضلك',
                    'title_en' => 'please select your location type ',
                    'type' => 'radio',
                    'service_id' => $service->id,
                ],

                [
                    'title_ar' => 'هل عربتك تهدر الوقود ؟',
                    'title_en' => 'is your vehicle leaking fuel ?',
                    'type' => 'radio',
                    'service_id' => $service->id,
                ],
                [
                    'title_ar' => 'اختر نوع الموقع من فضلك',
                    'title_en' => 'please select your location type ',
                    'type' => 'radio',
                    'service_id' => $service->id,
                ],

            ];
            foreach ($data as $get) {
                $question = Question::updateOrCreate($get);
                if ($question) {
                    $answers = [
                        [
                            'title_ar' => 'نعم',
                            'title_en' => 'yes',
                            'question_id' => $question->id,
                        ],
                        [
                            'title_ar' => 'لا',
                            'title_en' => 'no',
                            'question_id' => $question->id,
                        ],
                    ];
                    foreach ($answers as $row) {
                        Answer::updateOrCreate($row);
                    }
                }
            }
        }
    }
}
