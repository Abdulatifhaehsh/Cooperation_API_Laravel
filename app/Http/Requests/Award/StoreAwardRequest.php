<?php


namespace App\Http\Requests\Award;

use App\Models\Award;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreAwardRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Award::value => ['integer', 'required'],
            Award::title => ['string', 'required', Rule::unique(Award::table, Award::title)->whereNull(Award::deletedAt)],
            Award::description => ['string', 'required'],
            Award::image => ['file', 'required'],
            //
        ];
    }
}
