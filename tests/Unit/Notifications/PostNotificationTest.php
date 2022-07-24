<?php

namespace Tests\Unit\Notifications;

use App\Models\Post;
use App\Notifications\PostNotification;
use Carbon\Carbon;
use Mockery as m;
use Tests\TestCase;

class PostNotificationTest extends TestCase
{
    protected $notification;
    protected $data;
    protected $noti;

    public function setUp(): void
    {
        parent::setUp();
        $this->data = [
            'message' => 'test message',
            'urlPost' => 'url-post',
            'created_at' => Carbon::now()->toDateTimeString(),
        ];
        $this->notification = new PostNotification($this->data);
        $this->notifiable = m::mock(Post::class)->makePartial();
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->data);
        unset($this->notification);
        parent::tearDown();
    }

    public function testVia()
    {
        $this->assertEquals(['database'], $this->notification->via(Post::class));
    }

    public function testToArray()
    {
        $result = $this->notification->toArray($this->notifiable);
        $this->assertIsArray($result);
    }
}
