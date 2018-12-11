<?php

use Illuminate\Database\Seeder;
use App\Question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'product_id' => '1',
            'question' => 'Which color is your favorite?',
        ]);
        Question::create([
            'product_id' => '1',
            'question' => 'Do You currently own this product?',
        ]);
    }
}
