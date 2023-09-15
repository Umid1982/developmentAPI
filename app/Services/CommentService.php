<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    /** @throws \Exception */

    public function commentList()
    {
        return Comment::all();
    }

    public function storeComment($validate)
    {
        $comment = Comment::query()->create($validate);

        return $comment;
    }

    public function updateComment($validate, Comment $comment)
    {
        $comment->update($validate);

        return $comment->refresh();
    }

    public function delete(Comment $comment)
    {
        $comment->delete();
    }
}
