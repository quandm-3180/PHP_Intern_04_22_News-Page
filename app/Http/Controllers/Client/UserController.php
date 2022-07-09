<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $categoryRepo;
    protected $userRepo;

    public function __construct(
        CategoryRepositoryInterface $categoryRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->categoryRepo = $categoryRepo;
        $this->userRepo = $userRepo;
    }
    public function index()
    {
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $user = Auth::user();

        return view('client.user.index', compact('categories', 'user'));
    }

    public function edit()
    {
        $categories = $this->categoryRepo->getCategoryListStatusIsShow();
        $user = Auth::user();

        return view('client.user.edit', compact('categories', 'user'));
    }

    public function update(UpdateRequest $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $this->userRepo->update($user->id, $data);

        return redirect()->route('client.user.index');
    }
}
