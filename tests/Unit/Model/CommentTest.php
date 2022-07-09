<?php

namespace Tests\Unit\Model;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class CommentTest extends ModelTestCase
{
    protected $comment;

    public function initModel()
    {
        return new Comment();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'content',
            'status',
            'post_id',
            'user_id',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'comments',
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

    public function testPostRelation()
    {
        $relation = $this->model->post();
        $related = new Post();
        $this->assertBelongsToRelation(
            $relation,
            $this->model,
            $related,
        );
    }
}
