<?php

namespace App\Http\Controllers\ProductsManage;

use App\Product;
use App\Question;
use App\Answer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productID = $_GET['productID'];
        return view('productsManage/questionsManage/create', ['id' => $productID]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newQuestion = $request->input('question');
        $answerCnt = $request->input('answerCnt');
        $productId = $request->input('productId');

        $question = new Question;
        $question->product_id = $productId;
        $question->question = $newQuestion;
        $question->save();

        for($i=0;$i<$answerCnt;$i++){
            $newAnswer = $request->input('answer'.$i);
            $answer = new Answer;
            $answer->question_id = $question->id;
            $answer->answer = $newAnswer;
            $answer->save();
        }

        return redirect('/admin/products/'.$productId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $answers = Question::find($id)->answers;
        $productID = $_GET['productID'];
        return view('productsManage/questionsManage/show', ['question' => $question, 'answers' => $answers, 'productID' => $productID]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newQuestion = $request->input('question');
        $cnt = $request->input('answerCnt');
        $productId = $request->input('productId');

        $lastAnswers = Question::find($id)->answers;
        foreach ($lastAnswers as $lastAnswer) {
            $lastAnswer->delete();
        }
        for($i=0;$i<$cnt;$i++){
            $newAnswer = $request->input('answer'.$i);
            if(isset($newAnswer)){
                $answer = new Answer;
                $answer->question_id = $id;
                $answer->answer = $newAnswer;
                $answer->save();
            }
        }

        $question = Question::find($id);
        $question->question = $newQuestion;
        $question->save();

        return redirect('/admin/products/questions/'.$id.'?productID='.$productId);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productID = $_GET['productID'];
        Question::destroy($id);
        return redirect('/admin/products/'.$productID);
    }
}
