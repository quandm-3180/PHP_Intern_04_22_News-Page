<?php

namespace Tests\Unit\Model;

use App\Models\Post;
use App\Models\Review;
use App\Models\User;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class ReviewTest extends ModelTestCase
{
    protected $review;

    public function initModel()
    {
        return new Review();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'content',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'reviews',
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
