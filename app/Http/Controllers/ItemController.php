<?php

namespace App\Http\Controllers;

use App\Http\Requests\Item\DeleteItemRequest;
use App\Http\Requests\Item\GetItemRequest;
use App\Http\Requests\Item\StoreItemRequest;
use App\Http\Requests\Item\UpdateItemRequest;
use App\Models\Item;
use Hashash\ProjectService\Helpers\FileClass;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(private Item $items, private FileClass $fileClass)
    {
    }

    public function store(StoreItemRequest $request)
    {
        $file = $request->file('image');
        $fileUri = $this->fileClass
            ->uploadFile(
                $file,
                time() . '.' . $file->extension(),
                'images/item/'
            );
        $data = $request->validated();
        $data['image'] = $fileUri;
        $item = $this->items->createData($data);
        if (empty($item))
            return ResponseHelper::operationFail();
        return ResponseHelper::create($item);
    }

    public function get(GetItemRequest $request)
    {
        return ResponseHelper::select($this->items->getData(orderType: "ASC"));
    }

    public function update(UpdateItemRequest $request)
    {
        $data = $request->validated();
        if ($request->has('image')) {
            $file = $request->file('image');
            $fileUri = $this->fileClass
                ->uploadFile(
                    $file,
                    time() . '.' . $file->extension(),
                    'images/item/'
                );
            $data['image'] = $fileUri;
        }
        $id = $data['id'];
        unset($data['id']);
        $item = $this->items->updateData(['id' => $id], $data);
        if (empty($item))
            return ResponseHelper::operationFail();
        return ResponseHelper::update('Updated successfully');
    }

    public function delete(DeleteItemRequest $request)
    {
        $item = $this->items->softDeleteData($request->validated());
        if (empty($item))
            return ResponseHelper::operationFail();
        return ResponseHelper::delete('Deleted successfully');
    }
}
