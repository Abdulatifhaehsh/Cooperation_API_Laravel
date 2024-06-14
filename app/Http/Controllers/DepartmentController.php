<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Requests\Department\GetDepartmentRequest;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Http\Requests\Department\DeleteDepartmentRequest;
use Hashash\ProjectService\Helpers\ResponseHelper;

class DepartmentController extends Controller
{
    //
    public function __construct(private Department $department)
    {
    }
    public function get(GetDepartmentRequest $request)
    {
        return ResponseHelper::select($this->department->getData(orderType: 'ASC'));
    }
    public function store(StoreDepartmentRequest $request)
    {
        $department = $this->department->createData($request->validated());
        if (empty($department))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($department);
    }



    public function update(UpdateDepartmentRequest $request)
    {
        $data = $request->validated();
        $id = $data['id'];
        unset($data['id']);
        $department = $this->department->updateData(['id' => $id], $data);
        if (empty($department))
            return ResponseHelper::operationFail();
        return ResponseHelper::update('Updated successfully');
    }

    public function delete(DeleteDepartmentRequest $request)
    {
        $department = $this->department->softDeleteData($request->validated());
        if (empty($department))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete('Deleted successfully');
    }
}
