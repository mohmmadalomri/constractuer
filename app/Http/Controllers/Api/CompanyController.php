<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Http\Traits\ImageTrait;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $company = Company::with('admin')->get();
        $CompanyWithUrls = $company->map(function ($Company) {
            $Company->logo = asset('attachments/company/'.$Company->id .'/'. $Company->logo);
            return $Company;
        });
        return response()->json([
            'company' => $CompanyWithUrls
        ], 200);
    }

    public function store(StoreCompanyRequest $request)
    {
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['link_website'] = $request->link_website;
        $data['link_facebook'] = $request->link_facebook;
        $data['link_twitter'] = $request->link_twitter;
        $data['link_youtube'] = $request->link_youtube;
        $data['link_linkedin'] = $request->link_linkdin;
        $data['address_1'] = $request->address_1;
        $data['address_2'] = $request->address_2;
        $data['country'] = $request->country;
        $data['governorate'] = $request->governorate;
        $data['city'] = $request->city;
        $data['zip_code'] = $request->zip_code;
        $data['user_id'] = $request->user_id;
        $company = Company::create($data);
        if ($request->hasfile('logo')) {
            $logo_image = $this->saveImage($request->logo, 'attachments/company/'.$company->id);
            $company->logo = $logo_image;
            $company->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Company Information Added Successfully',
            'date' => CompanyResource::collection($company->get()),
        ]);

    }


    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);

        $data = $request->all();
        if ($company) {
            $data['name'] = $request->name ? $request->name : $company->name;
            $data['phone'] = $request->phone ? $request->phone : $company->phone;
            $data['email'] = $request->email ? $request->email : $company->email;
            $data['link_website'] = $request->link_website;
            $data['link_facebook'] = $request->link_facebook;
            $data['link_twitter'] = $request->link_twitter;
            $data['link_youtube'] = $request->link_youtube;
            $data['link_linkedin'] = $request->link_linkedin;
            $data['address_1'] = $request->address_1 ? $request->address_1 : $company->address_1;
            $data['address_2'] = $request->address_2;
            $data['country'] = $request->country ? $request->country : $company->country;
            $data['governorate'] = $request->governorate ? $request->governorate : $company->governorate;
            $data['city'] = $request->city ? $request->city : $company->city;
            $data['zip_code'] = $request->zip_code ? $request->zip_code : $company->zip_code;
            $company->update($data);
            if ($request->hasfile('logo')) {
                $this->deleteFile('company',$id);
                $logo_image = $this->saveImage($request->logo, 'attachments/company/'.$id);
                $company->logo = $logo_image;
                $company->save();
            }
            $company->logo = asset('attachments/company/'.$company->id .'/'. $company->logo);

            return response()->json([
                'status' => true,
                'data' => $company,
                'message' => 'Company Information Updated Successfully',
            ]);
        }
    }

    public function show($id)
    {
        $company = Company::with('admin')->find($id);
        $company->logo = asset('attachments/company/'.$company->id .'/'. $company->logo);

        return response()->json([
            'company' => $company
        ], 200);
    }

    public function destroy($id)
    {
        $Company=  Company::find($id);
        if (!$Company) {
            return response()->json([
                'status' => false,
                'message' => 'not found Company',
            ]);
        }
        $this->deleteFile('company',$id);
        $Company->delete();
        return response()->json([
            'status' => true,
            'message' => 'Company Information deleted Successfully',
        ]);
    }

}
