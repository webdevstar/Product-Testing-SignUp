<?php

use Illuminate\Database\Seeder;
use App\Answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::create(array(
            'question_id' => '1',
            'answer' => 'Black',
        ));
        Answer::create(array(
            'question_id' => '1',
            'answer' => 'White',
        ));
        Answer::create(array(
            'question_id' => '1',
            'answer' => 'Red',
        ));
        Answer::create(array(
            'question_id' => '1',
            'answer' => 'Gold',
        ));
        Answer::create(array(
            'question_id' => '1',
            'answer' => 'Other',
        ));
        Answer::create(array(
            'question_id' => '2',
            'answer' => 'Yes of Course',
        ));
        Answer::create(array(
            'question_id' => '2',
            'answer' => 'No but I used too',
        ));
        Answer::create(array(
            'question_id' => '2',
            'answer' => 'No they are too expensive',
        ));
    }
}
