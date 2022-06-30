<?php

namespace Tests\Unit\Model;

use App\Models\Advertisement;
use App\Models\User;
use Tests\Unit\ModelTestCase;

class AdvertisementTest extends ModelTestCase
{
    protected $advertisement;

    public function initModel()
    {
        return new Advertisement();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'name',
            'user_id',
            'link',
            'status',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'advertisements',
                'fillable' => $fillable,
            ]
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
}
