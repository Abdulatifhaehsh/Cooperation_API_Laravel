<?php


namespace App\Http\Requests\Department;

use App\Models\Department;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class DeleteDepartmentRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Department::table, 'id')->whereNull(Department::deletedAt)]

            //
        ];
    }


}
