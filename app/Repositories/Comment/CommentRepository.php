<?php

namespace App\Repositories\Comment;

use App\Models\Comment;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Repositories\BaseRepository;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return Comment::class;
    }

    public function getCommentsInPost($postId)
    {
        return $this->model->with('user')->where('post_id', $postId)
            ->orderByDesc('created_at')
            ->limit(config('custom.comment_in_post_num'))->get();
    }
}
