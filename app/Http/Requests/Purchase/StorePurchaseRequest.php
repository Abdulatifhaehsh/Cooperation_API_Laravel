<?php


namespace App\Http\Requests\Purchase;

use App\Models\Item;
use App\Models\Purchase;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StorePurchaseRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Purchase::itemId => ['integer', 'required', Rule::exists(Item::table, 'id')->whereNull(Item::deletedAt)],
            Purchase::quantity => ['integer', 'required']
        ];
    }
}
