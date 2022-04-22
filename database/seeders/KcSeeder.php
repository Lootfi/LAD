<?php

namespace Database\Seeders;

use App\Models\Kc;
use App\Models\KCQL;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KcSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kc::factory(3)->create()->each(function ($kc) {
            KCQL::query()->create([
                'kc_id' => $kc->id,
                'question_id' => 1,
                'lesson_id' => 1,
            ]);
        });

        Kc::factory(3)->create()->each(function ($kc) {
            KCQL::query()->create([
                'kc_id' => $kc->id,
                'question_id' => 2,
                'lesson_id' => 2,
            ]);
        });
    }
}
