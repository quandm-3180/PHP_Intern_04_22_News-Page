<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Post\PostRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $postRepo;
    protected $categoryRepo;
    protected $userRepo;
    protected $data;

    public function __construct(
        PostRepositoryInterface $postRepo,
        CategoryRepositoryInterface $categoryRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->data = [];
        $this->postRepo = $postRepo;
        $this->categoryRepo = $categoryRepo;
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $currentYear = Carbon::now()->year;
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $monthsChart = config('chart.months');

        foreach ($categories as $key => $category) {
            $posts = $this->postRepo->getPostByCategoryInCurrentYear($category->id, $currentYear);
            $categoryName[$key] = $category->name;

            $months[$key] = $posts->map(function ($post) {
                return (Carbon::parse($post->getRawOriginal('created_at'))->format('F'));
            });
            $countPostsInMonth[$key] = array_merge($monthsChart, array_count_values($months[$key]->toArray()));
        }

        $this->data['countPost'] = $this->postRepo->getPostList()->count();
        $this->data['countUser'] = $this->userRepo->getUsers()->count();
        $this->data['countWrite'] = $this->userRepo->getWrites()->count();

        $this->data['currentYear'] = $currentYear;
        $this->data['categoryName'] = json_encode($categoryName);
        $this->data['countPostsInMonth'] = json_encode($countPostsInMonth);

        return view('admin.dashboard.index', $this->data);
    }
}
