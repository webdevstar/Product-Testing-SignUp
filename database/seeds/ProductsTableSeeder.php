<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert(array(
            'name' => 'iPhone',
            'image' => 'https://im.d-promo.com/upload/1531500133_Beats_3_Red_2.png',
            'title' => 'Testers wanted for iPhone',
        ));
    }
}
