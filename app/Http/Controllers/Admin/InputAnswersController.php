<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Input;
use App\Models\InputAnswer;
use App\Models\InputSession;
use Illuminate\Http\Request;

class InputAnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lists = InputSession::with('user', 'inputs', 'answers', 'index')->get();

        foreach ($lists as $ls){
            $answers = $ls->answers->toArray();
            $qs = $ls->inputs->toArray();
            $qna = [];
            foreach ($qs as $i => $q) {
                $qna[] = [$q, $answers[$i]];
            }
            $ls->qna = $qna;
        }

        return view('admin.input-answers.index', compact('lists'));

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
        $asnweredinput = InputAnswer::where('input_session_id', '=', $id)->get();
        try {
            $asnweredinput->delete();
        } catch (\Exception $e) {

        }
        InputSession::find($id)->delete();

        return redirect()->back();
    }
}
