<?php


namespace App\Http\Requests\Comment;

use App\Models\Comment;
use App\Models\Post;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Comment::postId => ['integer', 'required', Rule::exists(Post::table, 'id')->whereNull(Post::deletedAt)],
            Comment::comment => ['string', 'required']
        ];
    }
}
