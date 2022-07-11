<?php

namespace App\Repositories\Category;

use App\Repositories\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getCategoryList();

    public function getCategory($id);

    public function creatCategory($options);

    public function getCategoryListStatusIsShow();
}
