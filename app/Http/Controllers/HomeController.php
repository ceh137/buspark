<?php

namespace App\Http\Controllers;
use App\Models\CheckListSession;
use App\Services\GoogleService;
use Revolution\Google\Sheets\Sheets;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $list = CheckListSession::with('user', 'check_list', 'questions', 'answers')->where('id', '=', 11)->first();

        $service = new GoogleService();
        $data = [[$list->id, $list->user->name, $list->check_list->text_btn, $list->bus_number, $list->created_at->format('Y.m.d H:i:s')]];
        $questions = [];
        foreach ($list->questions as $q) {
            $questions[] = $q->question;
        }
        array_push($data,$questions);
        $answers = [];
        foreach ($list->answers as $ans) {
            $answers[] = $ans->text;
        }
        array_push($data,$answers);
        dd($data);
    }
}
