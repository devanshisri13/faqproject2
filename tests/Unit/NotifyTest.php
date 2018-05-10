<?php

namespace Tests\Unit;

use Illuminate\Notifications\NotificationSender;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class NotifyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNotify()
    {
         NotificationSender::fake();

        $this->profile();

        $this->question(
            route('questions.answers.store', $this->question->id),
            $this->answer->toArray()
        );

        Notification::assertSentTo($this->user, AnswerPosted::class);
    }


}
