<?php

namespace Tests\Unit\Model;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\DB;
use Tests\Unit\ModelTestCase;

class CategoryTest extends ModelTestCase
{
    protected $category;

    public function initModel()
    {
        return new Category();
    }

    public function testModelConfiguration()
    {
        $fillable = [
            'name',
            'slug',
            'status',
        ];
        $this->runConfigurationAssertions(
            $this->model,
            [
                'table' => 'categories',
                'fillable' => $fillable,
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

    public function testStatusGetter()
    {
        $category = $this->model;
        $this->assertEquals('Hidden', $category->getStatusAttribute(config('custom.category_status.hidden')));
        $this->assertEquals('Show', $category->getStatusAttribute(config('custom.category_status.show')));
    }

    public function testScopeIsShow()
    {
        $category = $this->model;
        $this->assertEquals(
            $category->isShow()->toSql(),
            DB::table('categories')->where('status', config('custom.category_status.show'))->toSql(),
        );
    }
}
