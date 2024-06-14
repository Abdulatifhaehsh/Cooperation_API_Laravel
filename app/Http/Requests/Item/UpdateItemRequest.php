<?php


namespace App\Http\Requests\Item;

use App\Models\Item;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateItemRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Item::table, 'id')->whereNull(Item::deletedAt)],
            Item::value => ['integer', 'required'],
            Item::title => ['string', 'required', Rule::unique(Item::table, Item::title)->whereNot('id', $this->id)->whereNull(Item::deletedAt)],
            Item::description => ['string', 'required'],
            Item::quantity => ['integer', 'required'],
            Item::image => ['file', 'required'],
        ];
    }
}
