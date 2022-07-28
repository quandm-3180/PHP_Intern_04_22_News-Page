<?php

namespace Tests\Unit\Http\Controller\Admin;

use App\Events\PostStatusChangesNotificationEvent;
use App\Http\Controllers\Admin\PostController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use App\Models\Notification as ModelNotification;
use App\Notifications\PostNotification;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Image\ImageRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Mockery as m;
use Tests\TestCase;

class PostControllerTest extends TestCase
{

    protected $controller;
    protected $postRepo;
    protected $categoryRepo;
    protected $imageRepo;
    protected $post;
    protected $user;
    protected $category;
    protected $notifications;

    public function setUp(): void
    {
        parent::setUp();
        $this->postRepo = m::mock(PostRepositoryInterface::class)->makePartial();
        $this->imageRepo = m::mock(ImageRepositoryInterface::class)->makePartial();
        $this->categoryRepo = m::mock(CategoryRepositoryInterface::class)->makePartial();
        $this->controller = new PostController($this->postRepo, $this->categoryRepo, $this->imageRepo);
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->controller);
        parent::tearDown();
    }

    public function testChangePostStatus()
    {
        Notification::fake();
        Event::fake();

        $id = 1;
        $status = config('custom.post_status.approved');
        $options['status'] = $status;

        $this->user = User::factory()->make();
        $this->post = Post::factory()->make();
        $this->notifications = ModelNotification::factory()->count(2)->make();
        $this->category = Category::factory()->make();
        $this->postRepo->shouldReceive('update')->with($id, $options)
            ->andReturn($this->post);

        $this->post->setRelation('user', $this->user);
        $this->post->setRelation('category', $this->category);
        $this->user->setRelation('notifications', $this->notifications);

        $response = $this->controller->changePostStatus($id, $status);
        Notification::assertSentTo($this->user, PostNotification::class);
        Event::assertDispatched(PostStatusChangesNotificationEvent::class);
        $this->assertEquals(200, $response->getStatusCode());
    }
}
