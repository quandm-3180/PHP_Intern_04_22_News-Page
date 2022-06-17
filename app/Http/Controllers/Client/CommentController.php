<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreRequest;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    public function store(StoreRequest $request, $postId)
    {
        $comment = new Comment();
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $postId;
        $comment->content = $request->content;
        $comment->save();

        return response()->json([
            'code' => 200,
        ]);
    }
}
