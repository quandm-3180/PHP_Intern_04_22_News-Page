<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepo;
    protected $categoryRepo;
    protected $commentRepo;

    public function __construct(
        PostRepositoryInterface $postRepo,
        CategoryRepositoryInterface $categoryRepo,
        CommentRepositoryInterface $commentRepo
    ) {
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
        $this->commentRepo = $commentRepo;
    }
    public function homepage()
    {
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $popularPosts = $this->postRepo->getListOfPopularPost();
        $recentPosts = $this->postRepo->getListOfRecentPosts();
        $recentPostofTravle = $this->postRepo->getRecentPostofTravle();
        $recentPostofFood = $this->postRepo->getRecentPostofFood();
        $recentPostofFashion = $this->postRepo->getRecentPostofFashion();
        $postHotinSidebar = $this->listPostHotinSidebar();

        return view('client.home.index', compact(
            'categories',
            'popularPosts',
            'recentPosts',
            'recentPostofTravle',
            'recentPostofFood',
            'recentPostofFashion',
            'postHotinSidebar',
        ));
    }

    public function postDetails($categorySlug, $postSlug)
    {
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $post = $this->postRepo->getApprovedPostBySlug($postSlug);
        $postHotinSidebar = $this->listPostHotinSidebar();
        $relatedPosts = $this->listRelatedPosts($post->category_id, $post->id);
        $comments = $this->getCommentsinPost($post->id);

        return view('client.post.post-details', compact(
            'categories',
            'post',
            'postHotinSidebar',
            'relatedPosts',
            'comments',
        ));
    }

    public function getPostbyCategory($categorySlug)
    {
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $category = $this->categoryRepo->getCategoryBySlug($categorySlug);
        $posts = $this->postRepo->getPostByCategory($category->id);
        $postHotinSidebar = $this->listPostHotinSidebar();

        return view('client.post.post-by-category', compact(
            'categories',
            'category',
            'posts',
            'postHotinSidebar',
        ));
    }

    public function listPostHotinSidebar()
    {
        $postHotinSidebar = $this->postRepo->getListPostHotinSidebar();

        return $postHotinSidebar;
    }

    public function searchPost(Request $request)
    {
        $keyword = $request->q;
        $listofSearchPost = $this->postRepo->getListofSearchPost($keyword);
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $postHotinSidebar = $this->listPostHotinSidebar();

        return view('client.post.search', compact('categories', 'listofSearchPost', 'keyword', 'postHotinSidebar'));
    }

    public function listRelatedPosts($categoryId, $postId)
    {
        $relatedPosts = $this->postRepo->getListRelatedPosts($categoryId, $postId);

        return $relatedPosts;
    }

    public function getCommentsinPost($postId)
    {
        $comments = $this->commentRepo->getCommentsInPost($postId);

        return $comments;
    }
}
