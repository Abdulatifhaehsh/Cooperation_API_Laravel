<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchase\StorePurchaseRequest;
use App\Models\Item;
use App\Models\Purchase;
use Hashash\ProjectService\Helpers\ResponseHelper;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct(private Purchase $purchases, private Item $items)
    {
    }

    public function store(StorePurchaseRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();
        $data[Purchase::userId] = $request->user()->id;
        $item = $this->items->findData(['id' => $data[Purchase::itemId]]);
        $data[Purchase::value] = $item[Item::value];
        if($item->quantity < $data[Purchase::quantity] || ($data[Purchase::quantity]* $data[Purchase::value]) > $user->wallet) {
            return ResponseHelper::invalidData('invalid quantity or price');
        }
        $item->quantity -= $data[Purchase::quantity];
        $user->wallet -= ($data[Purchase::quantity] * $data[Purchase::value]);
        $item->save();
        $user->save();
        $purchase = $this->purchases->createData($data);
        return ResponseHelper::create('successfully created');
    }

    public function get(Request $request)
    {
        return ResponseHelper::select($this->purchases->getData());
    }
}
