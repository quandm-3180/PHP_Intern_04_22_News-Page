<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\BaseRepository;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    //lấy model tương ứng
    public function getModel()
    {
        return Category::class;
    }

    public function getCategoryList()
    {
        return $this->model->orderByDesc('created_at')->get();
    }

    public function getCategory($id)
    {
        return $this->model->findOrFail($id);
    }

    public function creatCategory($options)
    {
        return  $this->model->create($options);
    }

    public function getCategoryListStatusIsShow()
    {
        return $this->model->isShow()->get();
    }
}
