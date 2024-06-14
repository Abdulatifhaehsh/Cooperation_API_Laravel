<?php


namespace App\Http\Requests\Post;

use App\Models\Post;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeletePostRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Post::table, 'id')->whereNull(post::deletedAt)],
        ];
    }
}
