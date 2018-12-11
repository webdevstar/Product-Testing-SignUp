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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

        $lastAnswers = Question::find($id)->answers;
        foreach ($lastAnswers as $lastAnswer) {
            $lastAnswer->delete();
        }
        for($i=0;$i<$cnt;$i++){
            $newAnswer = $request->input('answer'.$i);
            $answer = new Answer;
            $answer->question_id = $id;
            $answer->answer = $newAnswer;
            $answer->save();
        }

        $question = Question::find($id);
        $question->question = $newQuestion;
        $question->save();

        return redirect('/admin/products/questions/'.$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
