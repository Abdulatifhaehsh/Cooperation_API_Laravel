<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reaction\StoreReactionCommentRequest;
use App\Http\Requests\Reaction\StoreReactionPostRequest;
use App\Models\Reaction;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function __construct(private Reaction $reactions)
    {
    }

    public function storeReactionForPost(StoreReactionPostRequest $request)
    {
        $data = $request->validated();
        $data[Reaction::userId] = $request->user()->id;
        $reaction = $this->reactions->findData($data);
        if (!empty($reaction)) {
            $deleteReaction = $this->reactions->forceDeleteData(['id' => $reaction->id]);
            if (empty($deleteReaction))
                return ResponseHelper::operationFail();
            return ResponseHelper::create('deleted reaction');
        } else {
            $createReaction = $this->reactions->createData($data);
            if (empty($createReaction))
                return ResponseHelper::operationFail();
            return ResponseHelper::create('added reaction');
        }
    }

    public function storeReactionForComment(StoreReactionCommentRequest $request)
    {
        $data = $request->validated();
        $data[Reaction::userId] = $request->user()->id;
        $reaction = $this->reactions->findData($data);
        if (!empty($reaction)) {
            $deleteReaction = $this->reactions->forceDeleteData(['id' => $reaction->id]);
            if (empty($deleteReaction))
                return ResponseHelper::operationFail();
            return ResponseHelper::create('deleted reaction');
        } else {
            $createReaction = $this->reactions->createData($data);
            if (empty($createReaction))
                return ResponseHelper::operationFail();
            return ResponseHelper::create('added reaction');
        }
    }
}
