<?php

namespace App\Http\Controllers\ProductsTest;

use App\Product;
use App\Question;
use App\Answer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsTestController extends Controller
{
    public function index($name)
    {
        $months = array(
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July ',
            'August',
            'September',
            'October',
            'November',
            'December',
        );
        $currentYear = date("Y");
        $products = Product::where('name', '=', $name)->first();
        if(isset($products)){
            $questions = Product::find($products->id)->questions;
            $questionData = [];

            $cnt = 0;
            foreach ($questions as $question) {
                array_push($questionData,[$question]);
                $answers = Question::find($question->id)->answers;
                array_push($questionData[$cnt], $answers);
                $cnt++;
            }

            return view('productsTest/productsTest', ['products' => $products, 'questionData' => $questionData, 'months' => $months, 'currentYear' => $currentYear]);
        }
        else echo "product none!";
    }
}
