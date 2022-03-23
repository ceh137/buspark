<?php

namespace App\Listeners;

use App\Events\CheckListCompleted;
use App\Models\CheckListSession;
use App\Services\GoogleService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendCheckListToGoogle
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CheckListCompleted  $event
     * @return void
     */
    public function handle(CheckListCompleted $event)
    {
        $list = CheckListSession::with('user', 'check_list', 'questions', 'answers')->where('id', '=', $event->check_list->id)->first();

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
        $service->saveDataToSheet($data);

    }
}
