<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert(array(
            ['product_id' => '1','question' => 'Which color is your favorite?',],
            ['product_id' => '2','question' => 'Do You Own Beats Headphones?',],
        ));
    }
}
