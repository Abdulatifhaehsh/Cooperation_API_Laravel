<?php


namespace App\Http\Requests\Post;

use App\Models\Award;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Post::tagId => ['integer', 'required', Rule::exists(Tag::table, 'id')->whereNull(Tag::deletedAt)],
            Post::awardId => [
                'integer',
                Rule::requiredIf($this->tag_id == 1),
                Rule::exists(Award::table, 'id')->whereNull(Award::deletedAt)
            ],
            Post::title => ['string', 'required'],
            Post::description => ['string', 'required'],
            'images' => ['array', Rule::requiredIf($this->tag_id != 1)],
            'award_users' => [
                'array', 'min:1',
                Rule::requiredIf($this->tag_id == 1)
            ],
            'images.*' => ['file'],
            'award_users.*' => ['integer', Rule::exists(User::table, 'id')->whereNull(User::deletedAt)],
        ];
    }
}
