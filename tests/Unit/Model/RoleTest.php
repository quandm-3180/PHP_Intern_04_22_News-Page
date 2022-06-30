<?php

namespace Tests\Unit\Model;

use App\Models\Role;
use App\Models\User;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class RoleTest extends ModelTestCase
{
    protected $role;

    public function initModel()
    {
        return new Role();
    }

    public function testModelConfiguration()
    {
        $this->runConfigurationAssertions(
            $this->model,
            ['table' => 'roles'],
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
