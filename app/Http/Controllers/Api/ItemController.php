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
        return response()->json($items);
    }

    public function store(StoreItemRequest $request)
    {
        $data['name'] = $request->name ;
        $data['type'] = $request->type ;
        $data['describe'] = $request->describe ;
        $data['price'] = $request->price ;
        $data['company_id'] = $request->company_id ;

            $item_image = $request->file('image')->store('item_image','public');
            $data['image']  =$item_image;

        $item = Item::create($data);
        return response()->json([
            'status'=>true,
            'date' =>$item,
            'message' => 'Item  Added Successfully',
        ]);

    }

    public function show(Request $request)
    {
        $item = Item::findOrFail($request->id);
        return response()->json($item);
    }


    public function update(UpdateItemRequest $request, $id)
    {
        
        $item = Item::findOrFail($id);
        if($item)
        {
            $data['name'] = $request->name ? $request->name : $item->name;
            $data['type'] = $request->type ? $request->type : $item->type ;
            $data['describe'] = $request->describe ? $request->describe : $item->describe ;
            $data['price'] = $request->price ? $request->price : $item->price ;
            $data['company_id'] = $request->company_id ?$request->company_id : $item->company_id ;

            if ($request->file('image'))
            {
                if ($item->image != '')
                {
                    if (File::exists('storage/item_image/' . $item->image))
                        {
                        unlink('storage/item_image/' . $item->image);
                    }
                }
                $item_image = $request->file('image')->store('item_image','public');
                $data['image']  =$item_image;
            }

            $item->update($data);
            return response()->json([
                'status'=>true,
                'data' => $item,
                'message' => 'Item Updated Successfully',
            ]);
        }
    }

    public function destroy($id)
    {
        Item::find($id)->delete();
        return response()->json([
            'status'=>true,
            'message' => 'Item deleted Successfully',
        ]);
    }
}
