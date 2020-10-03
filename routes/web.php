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
