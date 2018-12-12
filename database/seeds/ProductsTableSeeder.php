<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create(array(
            'name' => 'iPhone',
            'image' => '//upload.wikimedia.org/wikipedia/commons/thumb/1/14/IPhone_XS_Max_Silver.svg/186px-IPhone_XS_Max_Silver.svg.png',
            'title' => 'Testers wanted for iPhone',
        ));
    }
}
