<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->paginate(config('custom.per_page'));

        return view('admin.user.index', compact('users'));
    }

    public function changeUserStatus($id, $userStatus)
    {
        $user = User::findOrFail($id);
        $user->status = $userStatus;

        if ($user->id == Auth::user()->id && $userStatus == config('custom.user_status.block')) {
            return response()->json([
                'code' => 400,
                'message' => __('messages.cannot-block-myself'),
            ]);
        };

        $user->update();

        return response()->json([
            'code' => 200,
            'message' => __('messages.update-success'),
        ]);
    }
}
