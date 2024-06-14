<?php


namespace App\Http\Requests\Rating;

use App\Models\Activity;
use App\Models\Rating;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreRatingRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Rating::activityId => ['integer', 'required', Rule::exists(Activity::table, 'id')->whereNull(Activity::deletedAt)],
            Rating::comment => ['string', 'required'],
            Rating::starCount => ['integer', 'required']
        ];
    }
}
