<?php

namespace Database\Seeders;

use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //q1
        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'Which of these are OCL types?',
            'order' => 1,
        ]);

        //1
        QuizAnswer::factory(1)->create([
            'question_id' => 1,
            'right_answer' => true,
            'answer' => 'Boolean',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 1,
            'right_answer' => true,
            'answer' => 'Real',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 1,
            'right_answer' => false,
            'answer' => 'Char',
        ]);

        // ===================================
        // ===================================

        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'Which of these statements concerning OCL navigation is true?',
            'order' => 2,
        ]);

        //4
        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => true,
            'answer' => 'Navigation is the process of moving from one object to another.',
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 2,
            'right_answer' => false,
            'answer' => 'Navigation is a function of the OCL types.',
        ]);

        // ===================================
        // ===================================

        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'The "oclIsTypeOf (t : OclType)" operation returns a:',
            'order' => 3,
        ]);

        //6
        QuizAnswer::factory(1)->create([
            'question_id' => 3,
            'right_answer' => true,
            'answer' => 'Boolean',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 3,
            'right_answer' => false,
            'answer' => 'Real',
        ]);
        QuizAnswer::factory(1)->create([
            'question_id' => 3,
            'right_answer' => false,
            'answer' => 'Char',
        ]);

        // ===================================
        // ===================================

        //structural
        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'Which design pattern provides a single class which provides simplified methods required by client and delegates call to those methods?',
            'order' => 4,
        ]);

        //10
        QuizAnswer::factory(1)->create([
            'question_id' => 4,
            'right_answer' => true,
            'answer' => 'Facade',
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 4,
            'right_answer' => false,
            'answer' => 'Proxy',
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 4,
            'right_answer' => false,
            'answer' => 'Decorator',
        ]);

        // ===================================
        // ===================================

        //creational
        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'Which design pattern ensures that only one object of particular class gets created?',
            'order' => 5,
        ]);

        //13
        QuizAnswer::factory(1)->create([
            'question_id' => 5,
            'right_answer' => true,
            'answer' => 'Singleton',
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 5,
            'right_answer' => false,
            'answer' => 'Factory',
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 5,
            'right_answer' => false,
            'answer' => 'Builder',
        ]);

        // ===================================
        // ===================================

        // structural and creational

        QuizQuestion::factory()->create([
            'quiz_id' => 1,
            'question' => 'Which design pattern provides a way to access the object of a particular class without having to know its concrete class?',
            'order' => 6,
        ]);

        //16
        QuizAnswer::factory(1)->create([
            'question_id' => 6,
            'right_answer' => true,
            'answer' => 'Adapter',
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 6,
            'right_answer' => false,
            'answer' => 'Bridge',
        ]);

        QuizAnswer::factory(1)->create([
            'question_id' => 6,
            'right_answer' => false,
            'answer' => 'Composite',
        ]);

        // ===================================



        // QuizQuestion::factory()->create([
        //     'quiz_id' => 2,
        //     'question' => 'What is the capital of France?',
        //     'order' => 1,
        // ]);

        // QuizAnswer::factory(1)->create([
        //     'question_id' => 7,
        //     'right_answer' => true,
        //     'answer' => 'Paris',
        // ]);
        // QuizAnswer::factory(1)->create([
        //     'question_id' => 7,
        //     'right_answer' => false,
        //     'answer' => 'Berlin',
        // ]);





        // QuizQuestion::factory()->create([
        //     'quiz_id' => 2,
        //     'question' => 'What is the capital of Germany?',
        //     'order' => 2,
        // ]);
        // QuizAnswer::factory(1)->create([
        //     'question_id' => 8,
        //     'right_answer' => false,
        //     'answer' => 'Paris',
        // ]);
        // QuizAnswer::factory(1)->create([
        //     'question_id' => 8,
        //     'right_answer' => true,
        //     'answer' => 'Berlin',
        // ]);
    }
}
