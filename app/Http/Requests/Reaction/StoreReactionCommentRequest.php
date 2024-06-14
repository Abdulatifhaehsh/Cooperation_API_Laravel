<?php


namespace App\Http\Requests\Reaction;

use App\Models\Comment;
use App\Models\Reaction;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreReactionCommentRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Reaction::commentId => ['integer', 'required', Rule::exists(Comment::table, 'id')->whereNull(Comment::deletedAt)],
        ];
    }
}
