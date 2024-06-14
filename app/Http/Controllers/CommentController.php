<?php

namespace App\Http\Controllers;

use App\Http\Requests\Comment\StoreCommentRequest;
use App\Http\Requests\Comment\StoreReplyRequest;
use App\Models\Comment;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(private Comment $comments)
    {
    }

    public function storeComment(StoreCommentRequest $request)
    {
        $data = $request->validated();
        $data[Comment::userId] = $request->user()->id;
        $comment = $this->comments->createData($data);
        if (empty($comment))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($comment);
    }

    public function storeReply(StoreReplyRequest $request)
    {
        $data = $request->validated();
        $data[Comment::userId] = $request->user()->id;
        $comment = $this->comments->createData($data);
        if (empty($comment))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($comment);
    }
}
