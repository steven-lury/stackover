<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Answer;
use App\Models\User;
use App\Models\Question;

class UserQuestionAnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('answers')->delete();
        \DB::table('questions')->delete();
        \DB::table('users')->delete();
        User::factory()->count(3)->create()->each( function ($user)
        {
            $user->questions()->saveMany(
                Question::factory()->count(rand(3,9))->make()
            )
            ->each(function($q){
                $q->answers()->saveMany(
                    Answer::factory()->count(rand(1, 4))->make()
                );
            });
        });
    }
}
