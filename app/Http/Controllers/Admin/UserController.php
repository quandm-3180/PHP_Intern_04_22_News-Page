<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $users = $this->userRepo->getUserList();

        return view('admin.user.index', compact('users'));
    }

    public function changeUserStatus($id, $userStatus)
    {
        $user = $this->userRepo->getUser($id);
        $options['status'] = $userStatus;

        if ($user->id == Auth::user()->id && $userStatus == config('custom.user_status.block')) {
            return response()->json([
                'code' => 400,
                'message' => __('messages.cannot-block-myself'),
            ]);
        };

        $this->userRepo->update($id, $options);

        return response()->json([
            'code' => 200,
            'message' => __('messages.update-success'),
        ]);
    }
}
