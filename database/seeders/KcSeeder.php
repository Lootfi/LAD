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
        Kc::factory()->create()->each(function ($kc) {
            KCQL::query()->create([
                'kc_id' => $kc->id,
                'lesson_id' => 1,
                'question_id' => 1,
            ]);

            KCQL::query()->create([
                'kc_id' => $kc->id,
                'lesson_id' => 1,
                'question_id' => 2,
            ]);
        });

        Kc::factory(2)->create()->each(function ($kc) {
            KCQL::query()->create([
                'kc_id' => $kc->id,
                'lesson_id' => 1,
                'question_id' => 2,
            ]);

            KCQL::query()->create([
                'kc_id' => $kc->id,
                'lesson_id' => 2,
                'question_id' => 1,
            ]);
        });
    }
}
