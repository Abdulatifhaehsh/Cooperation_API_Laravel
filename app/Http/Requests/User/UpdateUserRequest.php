<?php


namespace App\Http\Requests\User;

use App\Models\User;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::firstName => ['string'],
            User::lastName => ['string'],
            User::image => ['file']
        ];
    }
}
