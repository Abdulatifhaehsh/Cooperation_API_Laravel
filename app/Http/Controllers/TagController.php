<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tag\DeleteTagRequest;
use App\Http\Requests\Tag\GetTagRequest;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Models\Tag;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(private Tag $tags)
    {
    }

    public function store(StoreTagRequest $request)
    {
        $tag = $this->tags->createData($request->validated());
        if (empty($tag))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($tag);
    }

    public function get(GetTagRequest $request)
    {
        return ResponseHelper::select($this->tags->getData(orderType: "ASC"));
    }

    public function update(UpdateTagRequest $request)
    {
        $data = $request->validated();
        $id = $data['id'];
        unset($data['id']);
        $tag = $this->tags->updateData(['id' => $id], $data);
        if (empty($tag))
            return ResponseHelper::operationFail();
        return ResponseHelper::update('Updated successfully');
    }

    public function delete(DeleteTagRequest $request)
    {
        $tag = $this->tags->softDeleteData($request->validated());
        if (empty($tag))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete('Deleted successfully');
    }
}
