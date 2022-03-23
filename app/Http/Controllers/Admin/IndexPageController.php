<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\AnsweredQuestion;
use App\Models\CheckList;
use App\Models\CheckListSession;
use App\Models\IndexPage;
use App\Models\Input;
use App\Models\InputAnswer;
use App\Models\InputSession;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $session_id =  97;


        $lists = IndexPage::all();
        return view('admin.index',compact('lists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.index-page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $req  =  $request->validate([
            'color'=>'required',
            'text_btn' => 'required'
        ]);
        IndexPage::create($req);
        return redirect()->back();
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
        try {
            $inputs=Input::where('index_page_id', '=', $id)->get('id');
            InputAnswer::whereIn('input_id', $inputs)->delete();
            $inputs=Input::where('index_page_id', '=', $id)->delete();
            InputSession::where('index_page_id', '=', $id)->delete();
        }catch (\Exception $e) {
        }

        IndexPage::find($id)->delete();
        return redirect()->back();
    }
}
