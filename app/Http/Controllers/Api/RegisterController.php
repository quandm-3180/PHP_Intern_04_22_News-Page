<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Repositories\User\UserRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    protected $userRepo;

    public function __construct(UserRepositoryInterface $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $this->userRepo->createUser([
                'role_id' => config('custom.user_roles.user'),
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

            return response()->json([
                'code' => 200,
                'message' => __('register_success'),
            ]);
        } catch (\Exception $ex) {
            return response()->json([
                'code' => 500,
                'error' => $ex->getMessage(),
            ]);
        }
    }
}
