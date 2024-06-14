<?php


namespace App\Http\Requests\Reaction;

use App\Models\Post;
use App\Models\Reaction;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreReactionPostRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Reaction::postId => ['integer', 'required', Rule::exists(Post::table, 'id')->whereNull(Post::deletedAt)],

        ];
    }
}
