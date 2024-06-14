<?php


namespace App\Http\Requests\Award;

use App\Models\Award;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateAwardRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Award::table, 'id')->whereNull(Award::deletedAt)],
            Award::value => ['integer'],
            Award::title => ['string', Rule::unique(Award::table, Award::title)->whereNot('id', $this->id)->whereNull(Award::deletedAt)],
            Award::description => ['string'],
            Award::image => ['file'],

            //
        ];
    }
}
