<?php


namespace App\Http\Requests\Registration;

use App\Models\Activity;
use App\Models\Registration;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreOrDeleteRegistrationRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            Registration::activityId => ['integer', 'required', Rule::exists(Activity::table, 'id')->whereNull(Activity::deletedAt)],
        ];
    }
}
