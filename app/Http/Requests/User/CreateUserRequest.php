<?php


namespace App\Http\Requests\User;

use App\Enums\UserType;
use App\Models\Department;
use App\Models\User;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::firstName => ['string', 'required'],
            User::lastName => ['string', 'required'],
            User::password => ['string', 'required'],
            User::username => ['string', 'required', Rule::unique(User::table, User::username)->whereNull(User::deletedAt)],
            User::phoneNumber => ['string', 'required', Rule::unique(User::table, User::phoneNumber)->whereNull(User::deletedAt)],
            User::departmentId => ['integer', 'required', Rule::exists(Department::table, 'id')->whereNull(Department::deletedAt)],
            User::userType => ['string', 'required', Rule::in(UserType::getValues())]
        ];
    }
}
