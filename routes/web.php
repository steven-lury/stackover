<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::resource('questions', 'App\Http\Controllers\QuestionsController')->except('show');
Route::get('questions/{slug}', 'App\Http\Controllers\QuestionsController@show')->name('questions.show');
Route::resource('questions.answers', 'App\Http\Controllers\AnswersController')->except(['index', 'show', 'create']);
Route::post('answers/{answer}/accept', 'App\Http\Controllers\AcceptAnswerController')->name('answer.accept');

Route::post('question/favorite/{question}', 'App\Http\Controllers\FavoritesController@store')->name('question.favorite');
Route::delete('question/favorite/{question}', 'App\Http\Controllers\FavoritesController@destroy')->name('question.unfavorite');

Route::post('questions/vote/{question}', 'App\Http\Controllers\VoteQuestionController')->name('question.vote');
Route::post('answers/vote/{answer}', 'App\Http\Controllers\VoteAnswerController')->name('answer.vote');
