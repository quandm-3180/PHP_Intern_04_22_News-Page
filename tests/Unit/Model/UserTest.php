<?php

namespace Tests\Unit\Model;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Review;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\TestCase;
use Tests\Unit\ModelTestCase;

class UserTest extends ModelTestCase
{
    const EXCEPTION = 4;
    protected $user;

    public function initModel()
    {
        return new User();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'name',
            'email',
            'password',
            'phone',
            'status',
        ];
        $hidden = [
            'password',
            'remember_token',
        ];
        $casts = [
            'email_verified_at' => 'datetime',
            'id' => 'int',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'users',
                'fillable' => $fillable,
                'hidden' => $hidden,
                'casts' => $casts,
            ],
        );
    }

    public function testPostRelation()
    {
        $relation = $this->model->posts();
        $related = new Post();
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

    public function testRoleRelation()
    {
        $relation = $this->model->role();
        $related = new Role();
        $this->assertBelongsToRelation(
            $relation,
            $this->model,
            $related,
        );
    }

    public function testStatusGetter()
    {
        $user = $this->model;
        $this->assertEquals('block', $user->getStatusAttribute(config('custom.user_status.block')));
        $this->assertEquals('active', $user->getStatusAttribute(config('custom.user_status.active')));
        $this->assertEquals('active', $user->getStatusAttribute(static::EXCEPTION));
    }

    public function testScopeIsAdmin()
    {
        $this->assertEquals(
            DB::table('users')->where('role_id', config('custom.user_roles.admin'))->toSql(),
            $this->model->isAdmin()->toSql()
        );
    }

    public function testScopeIsWriter()
    {
        $this->assertEquals(
            DB::table('users')->where('role_id', config('custom.user_roles.writer'))->toSql(),
            $this->model->isWriter()->toSql()
        );
    }
}
