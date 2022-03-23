<?php

namespace App\Observers;

use App\Models\CheckListSession;
use App\Services\GoogleService;

class CheckListSessionObserver
{
    /**
     * Handle the CheckListSession "created" event.
     *
     * @param  \App\Models\CheckListSession  $checkListSession
     * @return void
     */
    public function created(CheckListSession $checkListSession)
    {
        //
    }

    /**
     * Handle the CheckListSession "updated" event.
     *
     * @param  \App\Models\CheckListSession  $checkListSession
     * @return void
     */
    public function updated(CheckListSession $checkListSession)
    {
        //
    }

    /**
     * Handle the CheckListSession "deleted" event.
     *
     * @param  \App\Models\CheckListSession  $checkListSession
     * @return void
     */
    public function deleted(CheckListSession $checkListSession)
    {
        //
    }

    /**
     * Handle the CheckListSession "restored" event.
     *
     * @param  \App\Models\CheckListSession  $checkListSession
     * @return void
     */
    public function restored(CheckListSession $checkListSession)
    {
        //
    }

    /**
     * Handle the CheckListSession "force deleted" event.
     *
     * @param  \App\Models\CheckListSession  $checkListSession
     * @return void
     */
    public function forceDeleted(CheckListSession $checkListSession)
    {
        //
    }
}
