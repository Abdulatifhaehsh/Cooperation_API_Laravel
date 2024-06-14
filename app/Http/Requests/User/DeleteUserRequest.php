<?php


namespace App\Http\Requests\User;

use App\Models\User;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeleteUserRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(User::table, 'id')->whereNull(User::deletedAt)],
        ];
    }
}
