<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    protected $commentRepo;

    public function __construct(CommentRepositoryInterface $commentRepo)
    {
        $this->commentRepo = $commentRepo;
    }

    public function store(StoreRequest $request, $postId)
    {
        $options['user_id'] = Auth::user()->id;
        $options['post_id'] = $postId;
        $options['content'] = $request->content;
        $status = $this->commentRepo->create($options);

        if (!$status) {
            return response()->json([
                'code' => 400,
                'message' => __('something_wrong'),
            ]);
        }

        return response()->json([
            'code' => 200,
        ]);
    }
}
