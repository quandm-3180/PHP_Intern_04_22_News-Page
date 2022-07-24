<?php

namespace Tests\Unit\Http\Mail;

use App\Mail\PostStatisticsMail;
use App\Models\Post;
use Tests\TestCase;
use Mockery as m;

class PostStatisticsMailTest extends TestCase
{
    protected $mail;
    protected $users;
    protected $posts;

    public function setUp(): void
    {
        parent::setUp();
        $this->users = m::mock(User::class)->makePartial();
        $this->posts = m::mock(Post::class)->makePartial();
        $this->mail = new PostStatisticsMail(
            $this->users,
            $this->posts,
        );
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->mail);
        parent::tearDown();
    }

    public function testBuildSendMail()
    {
        $response = $this->mail->build();
        $this->assertInstanceOf(PostStatisticsMail::class, $response);
        $this->assertEquals('emails.post-statistic', $response->view);
    }
}
