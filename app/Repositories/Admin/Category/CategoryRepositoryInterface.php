<?php

namespace App\Repositories\Admin\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategoryList();

    public function getCategory($id);

    public function creatCategory($options);
}
