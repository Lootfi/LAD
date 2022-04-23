<?php

namespace Database\Seeders;

use App\Models\Kc;
use App\Models\KCL;
use App\Models\KCQ;
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
        $kc1 = Kc::factory()->create([
            'name' => 'kc1'
        ]);
        $kc2 = Kc::factory()->create([
            'name' => 'kc2'
        ]);

        // kc1 L1
        KCL::query()->create([
            'kc_id' => $kc1->id,
            'lesson_id' => 1,
        ]);

        // kc2 L2
        KCL::query()->create([
            'kc_id' => $kc2->id,
            'lesson_id' => 2,
        ]);



        // kc1 Questions
        KCQ::query()->create([
            'kc_id' => $kc1->id,
            'question_id' => 1,
        ]);

        //kc2 questions
        KCQ::query()->create([
            'kc_id' => $kc2->id,
            'question_id' => 1,
        ]);
        KCQ::query()->create([
            'kc_id' => $kc2->id,
            'question_id' => 2,
        ]);
        KCQ::query()->create([
            'kc_id' => $kc2->id,
            'question_id' => 3,
        ]);
    }
}
