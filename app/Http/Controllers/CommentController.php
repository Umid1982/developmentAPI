<?php

namespace App\Http\Controllers;

use App\Console\Constants\CommentResponseEnum;
use App\Http\Requests\Comment\StoreRequest;
use App\Http\Requests\Comment\UpdateRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(protected readonly CommentService $commentService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->commentService->commentList();

        return response([
            'data' => CommentResource::collection($data),
            'message' => CommentResponseEnum::COMMENTS_LIST,
            'success' => true
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $storeRequest)
    {
        $data = $this->commentService->storeComment($storeRequest->validated());

        return response([
            'data' => CommentResource::make($data->load('user')->load('company')),
            'message' => CommentResponseEnum::COMMENT_CREATE,
            'success' => true
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        return response([
            'data' => CommentResource::make($comment->load('user')->load('company')),
            'message' => CommentResponseEnum::COMMENT_SHOW,
            'success' => true,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $updateRequest, Comment $comment)
    {
        $data = $this->commentService->updateComment($updateRequest->validated(), $comment);

        return response([
            'data' => CommentResource::make($data->load('user')->load('company')),
            'message' => CommentResponseEnum::COMMENT_UPDATED,
            'success' => true,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        $this->commentService->delete($comment);

        return response([
            'message' => CommentResponseEnum::COMMENT_DELETED,
            'success' => true
        ]);
    }
}
