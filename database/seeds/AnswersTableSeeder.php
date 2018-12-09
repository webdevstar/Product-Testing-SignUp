<?php

use Illuminate\Database\Seeder;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert(array(
            ['question_id' => '1','answer' => 'Black',],
            ['question_id' => '1','answer' => 'White',],
            ['question_id' => '1','answer' => 'Red',],
            ['question_id' => '1','answer' => 'Gold',],
            ['question_id' => '1','answer' => 'Other',],
            ['question_id' => '2','answer' => 'Yes of Course',],
            ['question_id' => '2','answer' => 'No but I used too',],
            ['question_id' => '2','answer' => 'No they are too expensive',],
        ));
    }
}
