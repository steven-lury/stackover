<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use Illuminate\Http\Request;

class VoteAnswerController extends Controller
{
    public function __construct()
    {
            $this->middleware('auth');
    }

    public function __invoke(Answer $answer , Request $request)
    {
        $vote = (int) $request->vote;
        auth()->user()->votingAnswer($answer, $vote);
        return back();
    }
}
