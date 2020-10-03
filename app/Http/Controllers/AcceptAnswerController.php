<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;

class AcceptAnswerController extends Controller
{
    public function __invoke(Answer $answer)
    {
        $answer->question->best_answer_id = $answer->id;
        $answer->question->save();
        return back();
    }
}
