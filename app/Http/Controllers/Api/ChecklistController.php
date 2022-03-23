<?php

namespace App\Http\Controllers\Api;

use App\Events\CheckListCompleted;
use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\CheckList;
use App\Models\CheckQuestion;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function save(Request $request) {
        try {
            $checkList  = new CheckList();
            $checkList->text_btn = $request->check_list_name;
            $checkList->color = $request->color;
            if ($checkList->save()) {
                $id = $checkList->id;
                foreach ($request->questions as $q) {
                    $question = new CheckQuestion();
                    $question->question = $q['question'];
                    $question->instant_answer = 0;
                    $question->check_list_id = $id;
                    if ($question->save()) {
                        $q_id = $question->id;

                        foreach ($q['answers'] as $ans) {
                            $answer = new Answer();
                            $answer->text = $ans['text'];
                            $answer->check_question_id = $q_id;
                            if ($ans['is_OK'] === true || $ans['is_OK']  === 'true') {
                                $answer->is_right_swipe = true;
                            } else {
                                $answer->is_right_swipe = false;
                            }
                            $answer->save();

                        }

                    }
                }

            }

        }catch (\Exception $e) {
            return $e->getMessage();
        }

        return response()->json(['success' => true], 200) ;
    }
}
