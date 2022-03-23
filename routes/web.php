<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \Illuminate\Support\Facades;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/index', \App\Http\Controllers\IndexController::class)->name('index');
    Route::get('/inputs/{id}', [\App\Http\Controllers\InputController::class, 'index'])->name('inputs');
    Route::get('/checks', [\App\Http\Controllers\ChecksController::class, 'index'])->name('checks');
    Route::get('/checks/{id}/questions', [\App\Http\Controllers\ChecksController::class, 'questions'])->name('checks.questions');
    Route::post('/inputs/{id}/save', [\App\Http\Controllers\InputController::class, 'save'])->name('inputs.save');


});

Route::get('/admin/', function () {
    return redirect(\route('admin.index-page.index'));
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/index-page', \App\Http\Controllers\Admin\IndexPageController::class)->names('index-page');
    Route::resource('/user', \App\Http\Controllers\Admin\UserController::class)->names('user');
    Route::resource('/check-list', \App\Http\Controllers\Admin\CheckListController::class)->names('check-list');
    Route::resource('/input', \App\Http\Controllers\Admin\InputController::class)->names('input');
    Route::resource('/check-list-question', \App\Http\Controllers\Admin\CheckListQuestionController::class)->names('check-list-question');
    Route::resource('/check-list-answered', \App\Http\Controllers\Admin\CheckListAnsweredController::class)->names('check-list-answered');
    Route::resource('/input-answered', \App\Http\Controllers\Admin\InputAnswersController::class)->names('input-answered');

});
