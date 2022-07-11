<?php

namespace Tests\Unit\Model;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class PostTest extends ModelTestCase
{
    const EXCEPTION = 4;
    protected $post;

    public function initModel()
    {
        return new Post();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'name',
            'content',
            'category_id',
            'user_id',
            'is_popular',
            'slug',
            'status',
            'short_description',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'posts',
                'fillable' => $fillable,
            ],
        );
    }

    public function testUserRelation()
    {
        $relation = $this->model->user();
        $related = new User();
        $this->assertBelongsToRelation(
            $relation,
            $this->model,
            $related,
        );
    }

    public function testCategoryRelation()
    {
        $relation = $this->model->category();
        $related = new Category();
        $this->assertBelongsToRelation(
            $relation,
            $this->model,
            $related,
        );
    }

    public function testReviewRelation()
    {
        $relation = $this->model->reviews();
        $related = new Review();
        $this->assertHasManyRelation(
            $relation,
            $this->model,
            $related,
        );
    }

    public function testCommentRelation()
    {
        $relation = $this->model->comments();
        $related = new Comment();
        $this->assertHasManyRelation(
            $relation,
            $this->model,
            $related,
        );
    }

    public function testImageRelation()
    {
        $relation = $this->model->images();
        $related = new Image();
        $this->assertHasManyRelation(
            $relation,
            $this->model,
            $related,
        );
    }

    public function testStatusGetter()
    {
        $post = $this->model;
        $this->assertEquals('Pending', $post->getStatusAttribute(config('custom.post_status.pending')));
        $this->assertEquals('Cancel', $post->getStatusAttribute(config('custom.post_status.cancel')));
        $this->assertEquals('Approved', $post->getStatusAttribute(config('custom.post_status.approved')));
        $this->assertEquals('Rejected', $post->getStatusAttribute(config('custom.post_status.rejected')));
        $this->assertEquals('Pending', $post->getStatusAttribute(static::EXCEPTION));
    }

    public function testScopeIsApproved()
    {
        $this->assertInstanceOf(Builder::class, Post::isApproved());
    }

    public function testScopeIsPopular()
    {
        $this->assertInstanceOf(Builder::class, Post::isPopular());
    }

    public function testCreatedAtLocaleEnglishGetter()
    {
        $post = $this->model;
        App::setLocale(config('custom.locale.english'));
        $now = Carbon::now();

        $this->assertEquals(
            Carbon::parse($now)->format('M, d Y'),
            $post->createdAt,
        );
    }
    public function testCreatedAtLocaleVietnamGetter()
    {
        $post = $this->model;
        App::setLocale(config('custom.locale.vietnam'));
        $now = Carbon::now();

        $this->assertEquals(
            Carbon::parse($now)->format('d/m/Y'),
            $post->createdAt,
        );
    }
}
