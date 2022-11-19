<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ScreenSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(ServicesSeeder::class);
        $this->call(QuestionsSeeder::class);
    }
}
