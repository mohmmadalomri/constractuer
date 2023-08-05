<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{
use ImageTrait;
    public function index()
    {
        $items = Item::all();
        $professionWithUrls = $items->map(function ($item) {
            $item->image = url('attachments/items/'.$item->id .'/'. $item->image);
            return $item;
        });
        return response()->json([
            'items' => $professionWithUrls
        ], 200);
    }

    public function store(StoreItemRequest $request)
    {
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        $data['describe'] = $request->describe;
        $data['price'] = $request->price;
        $data['quantity'] = $request->quantity;
        $data['company_id'] = $request->company_id;
        $data['tax_id'] = $request->tax_id;

        $item=Item::create($data);
        if ($request->hasfile('image')) {
            $_image = $this->saveImage($request->image, 'attachments/items/'.$item->id);
            $item->image = $_image;
            $item->save();
        }
        $item->image = url('attachments/items/'.$item->id .'/'. $item->image);

        return response()->json([
            'status' => true,
            'date' => $item,
            'message' => 'Item  Added Successfully',
        ]);

    }

    public function show($id)
    {
        $item = Item::find($id);
        if (!$item) {
            return response()->json([
                'status' => false,
                'message' => 'not found Item',
            ]);
        }
        $item->image = url('attachments/items/'.$item->id .'/'. $item->image);

        return response()->json($item);
    }


    public function update(StoreItemRequest $request, $id)
    {

        $item = Item::find($id);
        $data=$request->all();
        if ($item) {
            $data['name'] = $request->name ? $request->name : $item->name;
            $data['type'] = $request->type ? $request->type : $item->type;
            $data['describe'] = $request->describe ? $request->describe : $item->describe;
            $data['price'] = $request->price ? $request->price : $item->price;
            $data['company_id'] = $request->company_id ? $request->company_id : $item->company_id;
            $data['tax_id'] = $request->tax_id? $request->tax_id : $item->tax_id;
            $data['quantity'] = $request->quantity ? $request->quantity : $item->quantity;


            if ($request->hasfile('image')) {
                $this->deleteFile('items',$id);
                $_image = $this->saveImage($request->image, 'attachments/items/'.$id);
                $item->image = $_image;
                $item->save();
            }

            $item->update($data);
            $item->image = url('attachments/items/'.$item->id .'/'. $item->image);
            return response()->json([
                'status' => true,
                'data' => $item,
                'message' => 'Item Updated Successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'Item not found id',
            ],502);
        }
    }

    public function destroy($id)
    {
        $Item = Item::find($id);
        if (!$Item) {
            return response()->json([
                'status' => false,
                'message' => 'not found Item',
            ]);
        }

        $this->deleteFile('items',$id);
        $Item->delete();
        return response()->json([
            'status' => true,
            'message' => 'Item Information deleted Successfully',
        ]);
    }
}
