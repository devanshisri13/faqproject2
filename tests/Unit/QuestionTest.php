<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Question;
use DB;
class QuestionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSave()
    {
        $user= factory(\App\User::class)->make();
        $user->save();
        $question = factory(\App\Question::class)->make();
        $question->user()->associate($user);
        $this->assertTrue($question->save());
    }

    public  function testMonthlyQuestions()
    {

        $questions = DB::table('questions')
            ->whereMonth('created_at', '05')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        $this->assertTrue($questions->save());
    }
}