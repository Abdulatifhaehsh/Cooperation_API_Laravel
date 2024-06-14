<?php


namespace App\Http\Requests\Tag;

use App\Models\Tag;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreTagRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Tag::name => ['string', 'required', Rule::unique(Tag::table, Tag::name)->whereNull(Tag::deletedAt)],
            Tag::isAdmin => ['boolean', 'required']
        ];
    }
}
