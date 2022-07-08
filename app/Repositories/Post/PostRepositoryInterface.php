<?php

namespace App\Repositories\Post;

use App\Repositories\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function getPostList();

    public function getPost($id);

    public function getPostStatusList();

    public function getPostBySlug($slug);

    public function getPostStatusApprovedList();
}
