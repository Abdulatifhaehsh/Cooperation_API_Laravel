<?php

namespace App\Http\Controllers;

use App\Models\Award;
use Illuminate\Http\Request;
use App\Http\Requests\Award\StoreAwardRequest;
use App\Http\Requests\Award\GetAwardRequest;
use App\Http\Requests\Award\UpdateAwardRequest;
use App\Http\Requests\Award\DeleteAwardRequest;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;

class AwardController extends Controller
{

    //
    public function __construct(private Award $awards, private FileClass $fileClass)
    {
    }

    public function store(StoreAwardRequest $request)
    {
        $file = $request->file('image');
        $fileUri = $this->fileClass
            ->uploadFile(
                $file,
                time() . '.' . $file->extension(),
                'images/award/'
            );
        $data = $request->validated();
        $data['image'] = $fileUri;
        $award = $this->awards->createData($data);
        if (empty($award))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($award);
    }

    public function get(GetAwardRequest $request)
    {
        return ResponseHelper::select($this->awards->getData(orderType: 'ASC'));
    }

    public function update(UpdateAwardRequest $request)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $file = $request->file('image');
            $fileUri = $this->fileClass
                ->uploadFile(
                    $file,
                    time() . '.' . $file->extension(),
                    'images/award/'
                );
            $data['image'] = $fileUri;
        }
        $id = $data['id'];
        unset($data['id']);
        $award = $this->awards->updateData(['id' => $id], $data);
        if (empty($award))
            return ResponseHelper::operationFail();
        return ResponseHelper::update('Updated successfully');
    }

    public function delete(DeleteAwardRequest $request)
    {
        $award = $this->awards->softDeleteData($request->validated());
        if (empty($award))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete('Deleted successfully');
    }
}
