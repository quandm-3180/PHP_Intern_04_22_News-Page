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

    public function getListofPopularPost()
    {
        return $this->model->with('images', 'category')->isApproved()->isPopular()->get();
    }

    public function getListOfRecentPosts()
    {
        return $this->model->with('images', 'category')->isApproved()->orderBy('created_at', 'desc')
            ->limit(config('custom.recent_post_num'))->get();
    }

    public function getApprovedPostBySlug($postSlug)
    {
        return $this->model->isApproved()->where('slug', $postSlug)->first();
    }

    public function getRecentPostofFood()
    {
        return $this->model->with('images', 'category')
            ->where('category_id', config('custom.category_text.food'))
            ->isApproved()->orderBy('created_at', 'desc')
            ->limit(config('custom.recent_post_by_category_num'))->get();
    }

    public function getRecentPostofFashion()
    {
        return $this->model->with('images', 'category')
            ->where('category_id', config('custom.category_text.fashion'))
            ->isApproved()->orderBy('created_at', 'desc')
            ->limit(config('custom.recent_post_by_category_num'))->get();
    }

    public function getRecentPostofTravle()
    {
        return $this->model->with('images', 'category')
            ->where('category_id', config('custom.category_text.travel'))
            ->isApproved()->orderBy('created_at', 'desc')
            ->limit(config('custom.recent_post_by_category_num'))->get();
    }

    public function getPostByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)->isApproved()
            ->orderBy('created_at', 'desc')->paginate(config('custom.per_page'));
    }

    public function getListPostHotinSidebar()
    {
        return $this->model->with('images', 'category')->isApproved()
            ->orderBy('created_at', 'desc')
            ->limit(config('custom.post_hot_in_sidebar_num'))->get();
    }

    public function getListofSearchPost($keyword)
    {
        return $this->model->with('images', 'category')->where('name', 'like', "%$keyword%")
            ->isApproved()->orderBy('created_at', 'desc')
            ->paginate(config('custom.per_page'));
    }

    public function getListRelatedPosts($categoryId, $postId)
    {
        return $this->model->with('images', 'category')->where('category_id', $categoryId)
            ->where('id', '!=', $postId)
            ->isApproved()->orderByDesc('created_at')
            ->limit(config('custom.related_posts_num'))->get();
    }

    public function getPostByCategoryInCurrentYear($categoryId, $currentYear)
    {
        return $this->model->isApproved()->where('category_id', $categoryId)
            ->whereYear('created_at', $currentYear)->get();
    }
}
