<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('checklists/{id}/questions', [\App\Http\Controllers\Api\QuestionsController::class, 'questions'])->name('checks.questions');
Route::get('checklists/{check_id}/question/{q_id}/OK/session/{session_id}', [\App\Http\Controllers\Api\QuestionsController::class, 'answerOK'])->name('checks.questions.answer.OK');
Route::post('checklists/{check_id}/question/{q_id}/answer/{ans_id}/session/{session_id}', [\App\Http\Controllers\Api\QuestionsController::class, 'answer'])->name('checks.questions.answer');
Route::get('checklists/{check_id}/session/{session_id}', [\App\Http\Controllers\Api\QuestionsController::class, 'sendSession'])->name('checks.questions.session.send');
Route::get('checklists/{check_id}/bus_number/{bus_number}/user/{user_id}', [\App\Http\Controllers\Api\QuestionsController::class, 'saveSession'])->name('checks.questions.session');
Route::post('admin/checklist/save', [\App\Http\Controllers\Api\ChecklistController::class, 'save']);
Route::post('admin/index-page/save', [\App\Http\Controllers\Api\IndexPageController::class, 'save']);

