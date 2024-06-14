<?php


namespace App\Http\Requests\Comment;

use App\Models\Comment;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreReplyRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Comment::commentId => ['integer', 'required', Rule::exists(Comment::table, 'id')->whereNull(Comment::deletedAt)],
            Comment::comment => ['string', 'required']
        ];
    }
}
