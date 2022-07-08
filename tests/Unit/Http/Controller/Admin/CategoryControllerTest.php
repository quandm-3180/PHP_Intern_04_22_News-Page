<?php

namespace Tests\Unit\Http\Controller\Admin;

use Mockery as m;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Tests\TestCase;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class CategoryControllerTest extends TestCase
{
    protected $categories;
    protected $category;
    protected $categoryRepo;
    protected $controller;

    public function setUp(): void
    {
        parent::setUp();
        $this->categories = Category::factory()->count(5)->make();
        $this->request = m::mock(Request::class);
        $this->categoryRepo = m::mock(CategoryRepositoryInterface::class)->makePartial();
        $this->controller = new CategoryController($this->categoryRepo);
    }

    public function tearDown(): void
    {
        m::close();
        unset($this->controller);
        parent::tearDown();
    }

    public function testIndex()
    {
        $this->categoryRepo->shouldReceive('getCategoryList')
            ->andReturn($this->categories);
        $view = $this->controller->index();
        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.category.index', $view->getName());
        $this->assertArrayHasKey('categories', $view->getData());
    }

    public function testCreate()
    {
        $view = $this->controller->create();
        $this->assertInstanceOf(View::class, $view);
        $this->assertEquals('admin.category.add', $view->getName());
    }

    public function testStore()
    {
        $data = [
            'name' => 'test category store',
        ];

        $request = new StoreCategoryRequest($data);
        $this->category = Category::factory()->make([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);
        $this->categoryRepo->shouldReceive('creatCategory')->andReturn(true);
        $response = $this->controller->store($request);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('success', session()->all());
    }

    public function testStoreFail()
    {
        $data = [
            'name' => 'test category store',
        ];

        $request = new StoreCategoryRequest($data);
        $this->category = Category::factory()->make([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
        ]);
        $this->categoryRepo->shouldReceive('creatCategory')->andReturn(null);
        $response = $this->controller->store($request);

        $this->assertEquals(302, $response->getStatusCode());
        $this->assertInstanceOf(RedirectResponse::class, $response);
        $this->assertArrayHasKey('error', session()->all());
    }

    public function testEdit()
    {
        $id = 1;
        $this->category = Category::factory()->make([
            'id' => $id,
            'name' => 'test edit controller',
            'slug' => 'test-edit-controller',
        ]);
        $this->categoryRepo->shouldReceive('getCategory')->with($id)->andReturn($this->category);

        $view = $this->controller->edit($id);
        $this->assertEquals('admin.category.edit', $view->getName());
    }

    public function testUpdate()
    {
        $id = 1;
        $data = [
            'name' => 'test category',
            'slug' => 'test-category',
        ];
        $request = new UpdateCategoryRequest($data);
        $this->categoryRepo->shouldReceive('update')->andReturn(true);
        $response = $this->controller->update($request, $id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('success', session()->all());
    }

    public function testUpdateFail()
    {
        $id = 1;
        $data = [
            'name' => 'test category',
            'slug' => 'test-category',
        ];
        $request = new UpdateCategoryRequest($data);
        $this->categoryRepo->shouldReceive('update')->andReturn(false);
        $response = $this->controller->update($request, $id);
        $this->assertEquals(302, $response->getStatusCode());
        $this->assertArrayHasKey('error', session()->all());
    }

    public function testDestroy()
    {
        $id = 1;
        $this->categoryRepo->shouldReceive('delete')->with($id)->andReturn(true);
        $response = $this->controller->destroy($id);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertIsString($response->getData()->message);
    }

    public function testDestroyFail()
    {
        $id = 1;
        $this->categoryRepo->shouldReceive('delete')->with($id)->andReturn(false);
        $response = $this->controller->destroy($id);

        $this->assertEquals(400, $response->getData()->code);
        $this->assertIsString($response->getData()->message);
    }
}
