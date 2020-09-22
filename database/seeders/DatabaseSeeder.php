<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Question;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::factory()->count(3)->create()->each( function ($user)
        {
            $user->questions()->saveMany(
                Question::factory()->count(rand(3,9))->make()
            );
        });
    }
}