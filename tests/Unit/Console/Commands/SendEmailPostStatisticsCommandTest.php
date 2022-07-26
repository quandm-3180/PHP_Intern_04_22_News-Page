<?php

namespace Tests\Unit\Console\Commands;

use App\Console\Commands\SendEmailPostStatisticsCommand;
use App\Mail\PostStatisticsMail;
use App\Models\User;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\Facades\Mail;
use Mockery as m;
use Tests\TestCase;

class SendEmailPostStatisticsCommandTest extends TestCase
{
    protected $user;
    protected $command;
    protected $userRepo;
    protected $postRepo;
    protected $data;
    protected $mail;

    public function setUp(): void
    {
        parent::setUp();
        $this->userRepo = m::mock(UserRepositoryInterface::class)->makePartial();
        $this->postRepo = m::mock(PostRepositoryInterface::class)->makePartial();
        $this->command = new SendEmailPostStatisticsCommand($this->userRepo, $this->postRepo);
        $this->mail = new PostStatisticsMail($this->data, $this->data);
        $this->users = User::factory()->count(5)->make();
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->command);
        parent::tearDown();
    }

    public function testHandle()
    {
        Mail::fake();
        $users = User::factory()->count(10)->make();
        $this->userRepo->shouldReceive('getWrites')->andReturn($users);
        $this->postRepo->shouldReceiVe('getPostByWriterInCurrentWeek')->andReturn();
        $response = $this->command->handle($this->userRepo, $this->postRepo);
        $this->assertTrue($response);
        Mail::assertQueued(PostStatisticsMail::class, 10);
    }
}
