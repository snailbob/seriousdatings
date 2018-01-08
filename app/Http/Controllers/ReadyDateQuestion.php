<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ReadyDateQuestions;
use App\ReadDateAnswers;

class ReadyDateQuestion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = ReadyDateQuestions::take(10)->get();
        $format_questions = $this->format_questions($questions);

        return response()->json($questions);
    }

    public function format_questions($data){
        $arr = array();

        if(!empty($data)){
            foreach($data as $r=>$value){
                $value['choices'] = explode('* ', $value['choices']);

                //format average
                $avrg = array();
                $choices_count = ($value['type'] == 'level') ? 7 : count($value['choices']);

                for($i = 0; $i < $choices_count; $i++){
                    $count = ReadDateAnswers::where('answer', $i)->where('question_id', $value['id'])->count();
                    $avrg[] = array(
                        'count'=>$count
                    );
                }
                $value['average'] = $avrg;

                $arr[] = $value;
            }
        }
        return $arr;
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
        //
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
        //
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
