<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends Controller
{

    public function index()
    {
        $professions = Profession::all();
        return response()->json([
            'professions' => $professions
        ], 200);
    }

    public function store(Request $request)
    {
        $profession = Profession::create($request->all());
        $logo_image = $request->file('image')->store('profession', 'public');
        return response()->json([
            'status' => true,
            'message' => 'created profession successfully',
            'data' => $profession
        ]);
    }


    public function show(Request $request, $id)
    {
        $profession = Profession::findOrFail($id);
        return response()->json($profession);
    }

    public function update(Request $request, $id)
    {
        $profession = Profession::findOrFail($id);

        if ($profession) {
            $data['name'] = $request->name ? $request->name : $profession->name;
            $data['describe'] = $request->describe ? $request->describe : $profession->describe;
            $data['image'] = $request->file('image') ? $request->file('image')->store('profession', 'public') : $profession->image;
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
