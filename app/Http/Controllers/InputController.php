<?php

namespace App\Http\Controllers;

use App\Models\IndexPage;
use App\Models\Input;
use App\Models\InputAnswer;
use App\Models\InputSession;
use App\Services\GoogleService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Location;

class InputController extends Controller
{
    public function index($id) {
        $btn = IndexPage::where("id",  '=', $id)->first();
        if ($btn->text_btn == "Чек Листы")  {
            return redirect(route('checks'));
        }


        $inputs = Input::where('index_page_id',  '=', $id)->with('options')->get();
        $btn_id = $id;

        return view('inputs', compact('inputs', 'btn_id'));
    }

    public function save(Request $request, $id)
    {
        $answers = $request->except('_token');
        $validation_rules = [];
        foreach ($answers as $index => $answer) {
            $validation_rules[$index] = 'required';
        }
        $inputs_id = $id;
        $answers = $request->validate($validation_rules);
        $indexes = [];
        foreach ($answers as $index => $answer) {
            $indexes[] = str_replace('_' , ' ', $index);
        }

        $ids = Input::whereIn('name', $indexes)->get(['name', 'id'])->toArray();
        $session = new InputSession();
        $session->user_id = auth()->user()->id;
        $session->index_page_id = $inputs_id;
        $session->save();
        $er = [];

        foreach ($answers as $index => $answer) {
            $inp_ans = new InputAnswer();
           foreach ($ids as $id) {

               if ($id['name'] == str_replace('_' , ' ', $index)) {
                   $inp_ans->input_id = $id['id'];
                   $inp_ans->answer = $answer;
                   $inp_ans->input_session_id = $session->id;
               }

           }
            $er[] = $inp_ans->save();
        }

        $list = InputSession::with('user', 'inputs', 'answers', 'index')->where('id', '=', $session->id)->first();

        $service = new GoogleService();
        $data = [[$list->id, $list->user->name, $list->index->text_btn, $list->created_at->format('Y.m.d H:i:s')]];
        $questions = [];
        foreach ($list->inputs as $q) {
            $questions[] = $q->label;
        }
        array_push($data,$questions);
        $answers = [];
        foreach ($list->answers as $ans) {
            $answers[] = $ans->answer;
        }
        array_push($data,$answers);

        $service->saveDataToSheet($data);



        return redirect(route('index'));
    }
}
