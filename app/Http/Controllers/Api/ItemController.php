<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ItemController extends Controller
{

    public function index()
    {
        $items = Item::all();
        return response()->json([
            'items' => $items
        ], 200);
    }

    public function store(StoreItemRequest $request)
    {
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        $data['describe'] = $request->describe;
        $data['price'] = $request->price;
        $data['company_id'] = $request->company_id;

        $data['quantity'] = $request->quantity;

        $data=$request->all();
        $image=$request->file('image');
        $data['image']=$this->images($image,null);

        $item = Item::create($data);
        return response()->json([
            'status' => true,
            'date' => $item,
            'message' => 'Item  Added Successfully',
        ]);

    }

    public function show($id)
    {
        $item = Item::findOrFail($id);
        return response()->json($item);
    }


    public function update(UpdateItemRequest $request, $id)
    {

        $item = Item::findOrFail($id);
        $data=$request->all();
        if ($item) {
            $data['name'] = $request->name ? $request->name : $item->name;
            $data['type'] = $request->type ? $request->type : $item->type;
            $data['describe'] = $request->describe ? $request->describe : $item->describe;
            $data['price'] = $request->price ? $request->price : $item->price;
            $data['company_id'] = $request->company_id ? $request->company_id : $item->company_id;

            $data['quantity'] = $request->quantity ? $request->quantity : $item->quantity;


            if ($request->file('image')) {
               $oldimage=$item->image;
                $image=$request->file('image');
                $data['image']=$this->images($image,$oldimage);
            }

            $item->update($data);
            return response()->json([
                'status' => true,
                'data' => $item,
                'message' => 'Item Updated Successfully',
            ]);
        }
    }

    public function destroy($id)
    {
        $item = Item::find($id);
//        Item::find($id)->delete();
        $item->delete();
        return response()->json([
            'status' => true,
            'message' => 'Item deleted Successfully',
        ]);
    }
}
