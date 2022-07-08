<?php

namespace App\Repositories\Post;

use App\Models\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }

    public function getPostList()
    {
        return $this->model->with('category')->orderByDesc('created_at')
            ->paginate(config('custom.per_page'));
    }

    public function getPost($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getPostStatusList()
    {
        return $this->model->with('images', 'category', 'user')
            ->orderByDesc('created_at')->paginate(config('custom.per_page'));
    }

    public function getPostBySlug($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function getPostStatusApprovedList()
    {
        return $this->model->with('images', 'category')->isApproved()
            ->orderBy('created_at', 'desc')
            ->limit(config('custom.post_hot_in_sidebar_num'))->get();
    }
}
