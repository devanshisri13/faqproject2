<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\notify;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class NotifyTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNotification()
    {
        Notification::fake();



        $user =$this->question;
        Notification::assertSentTo(
            $user,
            OrderShipped::class,
            function ($notification, $channels) use ($user) {
                $answer =$this->answer;
                return $notification->order->id === $answer->id;
            }
        );

        // Assert a notification was sent to the given users...
        Notification::assertSentTo(
            [$user], AnsweredQuestion::class
        );

        // Assert a notification was not sent...
        Notification::assertNotSentTo(
            [$user], AnotherNotification::class
        );
    }
}