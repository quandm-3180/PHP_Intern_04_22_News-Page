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

    public function getListOfRecentPosts();

    public function getListOfPopularPost();

    public function getApprovedPostBySlug($postSlug);

    public function getRecentPostofFood();

    public function getRecentPostofFashion();

    public function getRecentPostofTravle();

    public function getPostByCategory($categoryId);

    public function getListPostHotinSidebar();

    public function getListofSearchPost($keyword);

    public function getListRelatedPosts($categoryId, $postId);
}
