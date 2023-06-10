<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends Controller
{

    public function index()
    {
        $professions = Profession::with('company')->get();
        return response()->json([
            'professions' => $professions
        ], 200);
    }

    public function store(Request $request)
    {

        $data = $request->all();
        $image = $request->file('image');
        $data['image'] = $this->images($image, null);
        $profession = Profession::create($data);
        return response()->json([
            'status' => true,
            'message' => 'created profession successfully',
            'data' => $profession
        ]);
    }


    public function show($id)
    {
        $profession = Profession::with('company')->find($id);
        return response()->json([
            'profession' => $profession
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $profession = Profession::findOrFail($id);

        $data = $request->all();
        if ($request->hasFile('image')) {

            $oldimage = $profession->image;
            $image = $request->file('image');
            $data['image'] = $this->images($image, $oldimage);

        }
        if ($profession) {
            $data['name'] = $request->name ? $request->name : $profession->name;
            $data['describe'] = $request->describe ? $request->describe : $profession->describe;
            $profession->update($data);
//            return response()->json($profession);
            return response()->json([
                'status' => true,
                'message' => 'update profession',
                'data' => $profession
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'profession Information Updated error',
            ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $profession = Profession::findOrFail($id);
//        return response()->json($request);
        if ($profession) {
            $profession->delete();
            return response()->json([
                'status' => true,
                'message' => 'profession Information deleted Successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'not found profession',
            ]);
        }
    }
}
