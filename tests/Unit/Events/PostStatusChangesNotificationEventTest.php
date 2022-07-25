<?php

namespace Tests\Unit\Events;

use App\Events\PostStatusChangesNotificationEvent;
use PHPUnit\Framework\TestCase;

class PostStatusChangesNotificationEventTest extends TestCase
{
    protected $message;
    protected $authorId;
    protected $event;

    public function setUp(): void
    {
        parent::setUp();
        $this->message = [
            'id' => 1,
        ];
        $this->event =  new PostStatusChangesNotificationEvent($this->message, $this->authorId);
    }

    public function tearDown(): void
    {
        unset($this->event);
        parent::tearDown();
    }

    public function testBroadcastOn()
    {
        $channel = $this->event->broadcastOn();
        $this->assertEquals('channel-notification-', $channel->name);
    }

    public function testBroadcastAs()
    {
        $eventName = $this->event->broadcastAs();
        $this->assertEquals('notification-event', $eventName);
    }

    public function testBroadcastWith()
    {
        $message = $this->event->broadcastWith();
        $this->assertEquals($this->message, $message);
    }
}
