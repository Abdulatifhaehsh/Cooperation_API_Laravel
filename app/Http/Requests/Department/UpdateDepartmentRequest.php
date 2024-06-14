<?php


namespace App\Http\Requests\Department;

use App\Models\Department;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => ['integer', 'required', Rule::exists(Department::table, 'id')->whereNull(Department::deletedAt)],
            Department::section => ['string', 'required', Rule::unique(Department::table, Department::section)->whereNot('id', $this->id)->whereNull(Department::deletedAt)],
        ];
    }


}
