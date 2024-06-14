<?php


namespace App\Http\Requests\Award;

use App\Models\Award;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeleteAwardRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Award::table, 'id')->whereNull(Award::deletedAt)]
        ];
    }
}
