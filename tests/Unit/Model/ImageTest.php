<?php

namespace Tests\Unit\Model;

use App\Models\Image;
use App\Models\Post;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class ImageTest extends ModelTestCase
{
    protected $image;

    public function initModel()
    {
        return new Image();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'image',
            'post_id',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'images',
                'fillable' => $fillable,
            ],
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
