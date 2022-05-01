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

        $kc = Kc::factory()->create([
            'name' => 'ocl_types'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 3,
        ]);

        // ===================================

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 1,
        ]);

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 3,
        ]);

        // ===================================
        // ===================================

        $kc = Kc::factory()->create([
            'name' => 'ocl_navigation'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 3,
        ]);

        // ===================================

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 2,
        ]);

        // ===================================
        // ===================================

        $kc = Kc::factory()->create([
            'name' => 'ocl_operations'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 3,
        ]);

        // ===================================

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 3,
        ]);

        // ===================================
        // ===================================

        $kc = Kc::factory()->create([
            'name' => 'model-cascade'
        ]);


        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 1,
        ]);

        // ===================================
        // ===================================


        $kc = Kc::factory()->create([
            'name' => 'model-v'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 1,
        ]);


        // ===================================
        // ===================================

        $kc = Kc::factory()->create([
            'name' => 'model-spirale'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 1,
        ]);

        // ===================================
        // ===================================

        $kc = Kc::factory()->create([
            'name' => 'creation'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 2,
        ]);

        // ===================================

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 5,
        ]);

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 6,
        ]);

        // ===================================
        // ===================================

        $kc = Kc::factory()->create([
            'name' => 'structurels'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 2,
        ]);

        // ===================================

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 4,
        ]);

        KCQ::query()->create([
            'kc_id' => $kc->id,
            'question_id' => 6,
        ]);

        // ===================================
        // ===================================

        $kc = Kc::factory()->create([
            'name' => 'comportementaux'
        ]);

        KCL::query()->create([
            'kc_id' => $kc->id,
            'lesson_id' => 2,
        ]);

        // ===================================
        // ===================================


        // //kc2 questions
        // KCQ::query()->create([
        //     'kc_id' => $kc2->id,
        //     'question_id' => 1,
        // ]);
        // KCQ::query()->create([
        //     'kc_id' => $kc2->id,
        //     'question_id' => 2,
        // ]);
        // KCQ::query()->create([
        //     'kc_id' => $kc2->id,
        //     'question_id' => 3,
        // ]);
    }
}
