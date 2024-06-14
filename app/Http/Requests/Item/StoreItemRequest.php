<?php


namespace App\Http\Requests\Item;

use App\Models\Item;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreItemRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Item::value => ['integer', 'required'],
            Item::title => ['string', 'required', Rule::unique(Item::table, Item::title)->whereNull(Item::deletedAt)],
            Item::description => ['string', 'required'],
            Item::quantity => ['integer', 'required'],
            Item::image => ['file', 'required'],
        ];
    }
}
