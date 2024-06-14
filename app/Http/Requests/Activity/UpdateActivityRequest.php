<?php


namespace App\Http\Requests\Activity;

use App\Models\Activity;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateActivityRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Activity::table, 'id')->whereNull(Activity::deletedAt)],
            Activity::image => ['file', 'required'],
            Activity::title => ['string', 'required'],
            Activity::description => ['string', 'required'],
            Activity::location => ['string', 'required'],
            Activity::maxMembers => ['integer', 'required'],
            Activity::beginAt => ['date_format:Y-m-d H:i:s', 'required', 'after:registration_end'],
            Activity::endAt => ['date_format:Y-m-d H:i:s', 'required', 'after:begin_at'],
            Activity::registrationEnd => ['date_format:Y-m-d H:i:s', 'required'],

        ];
    }
}
