<?php


namespace App\Http\Requests\Activity;

use App\Models\Activity;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeleteActivityRequest extends BaseFormRequest
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
        ];
    }
}
