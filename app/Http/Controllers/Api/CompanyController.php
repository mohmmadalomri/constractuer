<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    //

    public function index()
    {
        $company = Company::with('admin')->get();
        return response()->json([
            'company' => $company
        ], 200);
    }

    public function store(StoreCompanyRequest $request)
    {
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['link_webiste'] = $request->link_webiste;
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

        if ($request->file('logo')) {
            $logo_image = $request->file('logo')->store('logo', 'public');
            $data['logo'] = $logo_image;
        }

        $company = Company::create($data);
        return response()->json([
            'status' => true,
            'date' => $company,
            'message' => 'Company Information Added Successfully',
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
            $data['link_webiste'] = $request->link_webiste;
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

            if ($request->file('logo')) {
                if ($company->logo != '') {
                    if (File::exists('storage/logo/' . $company->logo)) {
                        unlink('storage/logo/' . $company->logo);
                    }
                }
                $logo_image = $request->file('logo')->store('logo', 'public');
                $data['logo'] = $logo_image;
            }
            $company->update($data);
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
        return response()->json([
            'company' => $company
        ], 200);
    }

    public function destroy($id)
    {
        Company::find($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Company Information deleted Successfully',
        ]);
    }

}
