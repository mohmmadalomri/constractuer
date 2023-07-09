<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\ImageTrait;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Profession;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ProfessionController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $professions = Profession::with('company')->get();
        return response()->json([
            'professions' => $professions
        ]);
    }

    public function store(Request $request)
    {
        $Company = Company::find($request->company_id);
        if (!$Company) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'en' => 'not found this company_id ',
                'ar' => 'هذا غير موجود',
                'data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $profession=  Profession::create([
            'name'=>$request->name,
            'describe'=>$request->describe,
            'company_id'=>$request->company_id,
        ]);

        if ($request->hasfile('image')) {
            $profession_image = $this->saveImage($request->image, 'attachments/professions/'.$profession->id);
            $profession->image = $profession_image;
            $profession->save();
        }
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
        $Company = Company::find($request->company_id);
        if (!$Company) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'en' => 'not found this company_id ',
                'ar' => 'هذا غير موجود',
                'data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $professions = Profession::findOrFail($id);
        if (!$professions) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'en' => 'not found this profession_id ',
                'ar' => 'هذا غير موجود',
                'data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $professions->name = $request->input('name');
        $professions->describe = $request->input('describe');
        $professions->company_id = $request->input('company_id');
        $professions->save();
        if ($request->hasfile('image')) {
            $this->deleteFile('professions',$id);
            $profession_image = $this->saveImage($request->image, 'attachments/professions/'.$id);
            $professions->image = $profession_image;
            $professions->save();
        }
        if ($professions) {
            $status = 'Success';
            $status_code = ResponseAlias::HTTP_CREATED;
            $message = 'Profession Updated successfully';
            $message_ar='تم التحديث بنجاح';
        }
        else{
            $status = 'Error';
            $status_code = ResponseAlias::HTTP_INTERNAL_SERVER_ERROR;
            $message = 'Profession not created';
            $message_ar=' لم يتم التحديث بنجاح';
        }
        return response()->json([
            'status' => $status,
            'status_code'=>$status_code,
            'en' => $message,
            'ar' => $message_ar,
            'data' =>$professions
        ], $status_code);
    }

    public function destroy($id)
    {
        $profession = Profession::findOrFail($id);
        if (!$profession) {
            return response()->json([
                'status' => false,
                'message' => 'not found profession',
            ]);
        }

        $this->deleteFile('professions',$id);
        $profession->delete();
        return response()->json([
            'status' => true,
            'message' => 'profession Information deleted Successfully',
        ]);

    }
}
