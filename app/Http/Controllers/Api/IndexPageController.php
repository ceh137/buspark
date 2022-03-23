<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\IndexPage;
use App\Models\Input;
use App\Models\Option;
use Illuminate\Http\Request;

class IndexPageController extends Controller
{
    public function save(Request $request) {
        try {
            $index_page  = new IndexPage();
            $index_page->text_btn = $request->text_btn;
            $index_page->color = $request->color;
            if ($index_page->save()) {
                $id = $index_page->id;

                foreach ($request->questions as $q) {
                    $input = new Input();
                    $input->type = $q['type'];
                    $input->name = $q['name'].now();
                    $input->label = $q['input'];
                    $input->index_page_id = $id;
                    $input->needed = true;
                    if ($input->save() && $input->type === 'select') {
                        $i_id = $input->id;

                        foreach ($q['answers'] as $ans) {
                            $answer = new Option();
                            $answer->text = $ans['text'];
                            $answer->value = $ans['text'];
                            $answer->value = $ans['text'];
                            $answer->input_id = $i_id;
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
