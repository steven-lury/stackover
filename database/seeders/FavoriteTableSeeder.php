<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;

class FavoriteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('favorites')->delete();
        $userTotal = User::count();
        $userIds = User::pluck('id')->all();
        foreach(Question::all() as $question){
            for($i=0; $i<rand(1,$userTotal); $i++){
                $question->favorites()->attach($userIds[$i]);
            }
        }
    }
}
