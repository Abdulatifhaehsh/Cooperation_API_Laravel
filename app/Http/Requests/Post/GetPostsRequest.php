<?php


namespace App\Http\Requests\Post;

use App\Models\Post;
use App\Models\Tag;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class GetPostsRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Post::tagId => ['integer', 'required', Rule::exists(Tag::table, 'id')->whereNull(Tag::deletedAt)]
        ];
    }
}
