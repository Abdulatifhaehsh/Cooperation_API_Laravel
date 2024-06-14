<?php


namespace App\Http\Requests\Tag;

use App\Models\Tag;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Tag::table, 'id')->whereNull(Tag::deletedAt)],
            Tag::name => ['string', Rule::unique(Tag::table, Tag::name)->whereNot('id', $this->id)->whereNull(Tag::deletedAt)],
            Tag::isAdmin => ['boolean']
        ];
    }
}
