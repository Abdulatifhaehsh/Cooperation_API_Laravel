<?php

namespace App\Http\Controllers;

use App\Http\Requests\Activity\DeleteActivityRequest;
use App\Http\Requests\Activity\StoreActivityRequest;
use App\Http\Requests\Activity\UpdateActivityRequest;
use App\Models\Activity;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct(private Activity $activities, private FileClass $fileClass)
    {
    }

    public function store(StoreActivityRequest $request)
    {
        $file = $request->file('image');
        $fileUri = $this->fileClass
            ->uploadFile(
                $file,
                time() . '.' . $file->extension(),
                'images/activity/'
            );
        $data = $request->validated();
        $data['image'] = $fileUri;
        $activity = $this->activities->createData($data);
        if (empty($activity))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($activity);
    }

    public function get(Request $request)
    {
        return ResponseHelper::select($this->activities->getData([[Activity::endAt, ">", now()]]));
    }

    public function getHistory(Request $request)
    {
        return ResponseHelper::select($this->activities->getData([[Activity::endAt, "<", now()]]));
    }

    public function update(UpdateActivityRequest $request)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $file = $request->file('image');
            $fileUri = $this->fileClass
                ->uploadFile(
                    $file,
                    time() . '.' . $file->extension(),
                    'images/activity/'
                );
            $data['image'] = $fileUri;
        }
        $id = $data['id'];
        unset($data['id']);
        $activity = $this->activities->updateData(['id' => $id], $data);
        if (empty($activity))
            return ResponseHelper::operationFail();
        return ResponseHelper::update('Updated successfully');
    }

    public function delete(DeleteActivityRequest $request)
    {
        $activity = $this->activities->softDeleteData($request->validated());
        if (empty($activity))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete('Deleted successfully');
    }
}
