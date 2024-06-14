<?php


namespace App\Http\Requests\Department;

use App\Models\Department;
use Hashash\ProjectService\Bases\BaseFormRequest;
use Illuminate\Validation\Rule;

class StoreDepartmentRequest extends BaseFormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            Department::section => ['string', 'required', Rule::unique(Department::table, Department::section)->whereNull(Department::deletedAt)],

        ];
    }


}
