<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SaveDataToGoogle;
use App\Models\Answer;
use App\Models\AnsweredQuestion;
use App\Models\CheckList;
use App\Models\CheckListSession;
use App\Models\CheckQuestion;
use App\Services\GoogleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function MongoDB\BSON\toJSON;
use function PHPUnit\Framework\returnArgument;

class QuestionsController extends Controller
{

    public function sendSession($ans_id, $session_id) {

        $list = CheckListSession::with('user', 'check_list', 'questions', 'answers')->where('id', '=', $session_id)->first();

        $qs = array_unique($list->questions->toArray(), SORT_REGULAR);


        foreach ($qs as $q) {

            $ansq = AnsweredQuestion::where([
                ['question_id','=',$q['id']],
                ['session_id','=', $list->id],
            ])->get('answer_id')->toArray();
            $answers_str = [];
            $answers =[];
            foreach ($ansq as $a) {
                $answers[] = Answer::where('id', '=', $a['answer_id'])->get('text')->first()->toArray();
            }
            $get_ready_answers = [];
            foreach ($answers as $an){
                $get_ready_answers[] = $an['text'];
            }
            $ready_answers[] = implode('; ',$get_ready_answers);
        }
        $ready_questions = [];
        foreach ($qs as $q) {
            $ready_questions[]  =  $q['question'];
        }
        $data = [[$list->id, $list->user->name, $list->check_list->text_btn, $list->bus_number, $list->created_at->format('Y.m.d H:i:s')]];
        array_push($data,$ready_questions);
        array_push($data,$ready_answers);



//        $list = CheckListSession::with('user', 'check_list', 'questions', 'answers')->where('id', '=', $session_id)->first();
//        //$service = new GoogleService();
//        $data = [[$list->id, $list->user->name, $list->check_list->text_btn, $list->bus_number, $list->created_at->format('Y.m.d H:i:s')]];
//        $questions = [];
//        foreach ($list->questions as $q) {
//            $questions[] = $q->question;
//        }
//        array_push($data,$questions);
//        $answers = [];
//        foreach ($list->answers as $ans) {
//            $answers[] = $ans->text;
//        }
//        array_push($data,$answers);
//        //$service->saveDataToSheet($data);
        try {
            dispatch(new SaveDataToGoogle($data));
        } catch (\Exception $e) {
            return $e->getMessage();
        }


        return response(200);
    }

    public function saveSession($check_list_id, $bus_number, $user_id) {

        $session = new CheckListSession();
        $session->user_id = $user_id;
        $session->check_list_id = $check_list_id;
        $session->bus_number =$bus_number;
        $session->save();

        return $session->id;
    }

    public function questions($id)  {
        $questions =  CheckQuestion::where('check_list_id', '=', $id)->with('answers')->get();
        return $questions;
    }

    public function answerOK($check_id, $q_id, $session_id) {
        $answer =  Answer::where('check_question_id', '=', $q_id)->where('is_right_swipe', '=', true)->get('id')->first();
        $answeredQ = new AnsweredQuestion();
        $answeredQ->question_id = $q_id;
        $answeredQ->answer_id = $answer->id;
        $answeredQ->session_id = $session_id;
        $answeredQ->post_by_id = 1;

        if ($answeredQ->save()) {
            return response(200);
        } else {
            return response(502);
        }
    }

    public function answer($check_id, $q_id, $ans_id, $session_id, Request $request) {
        try {
            $answer =  Answer::where('check_question_id', '=', $q_id)->where('is_right_swipe', '=', false)->where('id', '=', $ans_id)->get('id')->first();

            foreach (explode(',',$ans_id)  as $ans) {
                $answeredQ = new AnsweredQuestion();
                $answeredQ->question_id = $q_id;
                $answeredQ->session_id = $session_id;
                $answeredQ->answer_id = $ans;
                $answeredQ->post_by_id = 1;
                $answeredQ->save();
                if ($request->hasFile('img')){
                    $file = $request->file('img');
                    $filename = time().'.'.$file->getClientOriginalExtension();
                    $file->storeAs('photos', $filename, 'public');
                }
            }


            return response()->json(['message' => 'file  has been successfully uploaded']);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

    }

}
