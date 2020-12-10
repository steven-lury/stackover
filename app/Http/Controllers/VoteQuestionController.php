<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class VoteQuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Question $question)
    {
        $vote = (int) request()->vote;
        $votes_count = auth()->user()->votingQuestion($question, $vote);
        if(request()->expectsJson()){
            return response()->json([
                'succesMdsg' => "thanks for your feedback",
                'votesCount' => $votes_count
            ]);
        }
        return back()->with([
                'successMsg' => "thanks for your feedback",
                'data' => ['votesCount' => $votes_count]
            ]);
    }
}
