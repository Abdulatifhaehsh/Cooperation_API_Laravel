<?php


namespace App\Http\Requests\User;

use App\Models\User;
use Hashash\ProjectService\Bases\BaseFormRequest;

class SignInRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            User::username => ['required', 'string'],
            User::password => ['required', 'string', 'min:4']
        ];
    }
}
