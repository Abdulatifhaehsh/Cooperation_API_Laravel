<?php


namespace App\Http\Requests\Item;

use App\Models\Item;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeleteItemRequest extends BaseFormRequest
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
        ];
    }
}
