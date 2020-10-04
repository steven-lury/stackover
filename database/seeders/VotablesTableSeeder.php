<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;

class VotablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('votables')->delete();
        $users = User::all();
        $usersCount = $users->count();
        $votes = [1, -1];
        foreach(Question::all() as $question){
            for($i=0; $i< rand(1,$usersCount); $i++){
                $user = $users[$i];
                $user->votingQuestion($question, $votes[rand(0,1)]);
            }
        }
        foreach(Answer::all() as $answer){
            for($i=0; $i< rand(1,2); $i++){
                $user = $users[$i];
                $user->votingAnswer($answer, $votes[rand(0,1)]);
            }
        }
    }
}
