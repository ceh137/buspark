<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnsweredQuestion;
use App\Models\CheckListSession;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CheckListAnsweredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $lists = CheckListSession::with('user', 'check_list', 'questions', 'answers')->get();
        foreach ($lists as $ls){
            $qs = array_unique($ls->questions->toArray(), SORT_REGULAR);
            $qna = [];


            foreach ($qs as $q) {

                $ansq = AnsweredQuestion::where([
                    ['question_id','=',$q['id']],
                    ['session_id','=', $ls->id],
                    ])->get('answer_id')->toArray();

                $answers = [];
                foreach ($ansq as $a) {
                    $answers[] = Answer::where('id', '=', $a['answer_id'])->get('text')->first()->toArray();
                }
                $qna[] = [$q, $answers];

            }
            $ls->qna = $qna;
        }


       return view('admin.check_list_answers.index', compact('lists'));
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
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
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {

        $asnweredq = AnsweredQuestion::where('session_id', '=', $id)->get();
        try {
            $asnweredq->delete();
        } catch (\Exception $e) {

        }
        CheckListSession::find($id)->delete();
        return redirect()->back();
    }
}
