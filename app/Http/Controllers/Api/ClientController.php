<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use Illuminate\Http\Request;
use App\Models\Client;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ClientController extends Controller
{

    public function index()
    {
        $clients = Client::with('company')->get();
        return response()->json([
            'clients' => $clients
        ], 200);
    }

    public function store(StoreClientRequest $request)
    {
        $data = $request->all();
        $client = Client::create($data);

        return response()->json([
            'massege' => 'client add sucssfuly',
            'client' => $client
        ], 200);
    }

    public function show($id)
    {
        $client = Client::with('projects', 'invoices')->find($id);
        if (!$client) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'en' => 'not found this $id ',
                'ar' => 'هذا غير موجود',
                'data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        return response()->json([
            'client' => $client
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $client = Client::find($id);
        if ($client) {
            $data['first_name'] = $request->first_name ? $request->first_name : $client->first_name;
            $data['last_name'] = $request->last_name ? $request->last_name : $client->last_name;
            $data['name_company'] = $request->name_company ? $request->name_company : $client->name_company;
            $data['Main_phone'] = $request->Main_phone ? $request->Main_phone : $client->Main_phone;
            $data['work_phone'] = $request->work_phone ? $request->work_phone : $client->work_phone;
            $data['mobile_phone'] = $request->mobile_phone;
            $data['home_phone'] = $request->home_phone;
            $data['fax_phone'] = $request->fax_phone;
            $data['other_phone'] = $request->other_phone;
            $data['Main_email'] = $request->Main_email;
            $data['work_email'] = $request->work_email ? $request->work_email : $client->work_email;
            $data['personal_email'] = $request->personal_email ? $request->personal_email : $client->personal_email;
            $data['home_email'] = $request->home_email ? $request->home_email : $client->home_email;
            $data['other_email'] = $request->other_email ? $request->other_email : $client->other_email;
            $data['link_website'] = $request->link_website ? $request->link_website : $client->link_website;
            $data['link_facebook'] = $request->link_facebook ? $request->link_facebook : $client->link_facebook;
            $data['link_twitter'] = $request->link_twitter ? $request->link_twitter : $client->link_twitter;
            $data['link_youtupe'] = $request->link_youtupe ? $request->link_youtupe : $client->link_youtupe;
            $data['link_linkedin'] = $request->link_linkedin ? $request->link_linkedin : $client->link_linkedin;
            $data['link_instagram'] = $request->link_instagram ? $request->link_instagram : $client->link_instagram;
            $data['address_1'] = $request->address_1 ? $request->address_1 : $client->address_1;
            $data['address_2'] = $request->address_2 ? $request->address_2 : $client->address_2;
            $data['country'] = $request->country ? $request->country : $client->country;
            $data['governorate'] = $request->governorate ? $request->governorate : $client->governorate;
            $data['city'] = $request->city ? $request->city : $client->city;
            $data['status'] = $request->status ? $request->status : $client->status;
            $data['company_id'] = $request->company_id ? $request->company_id : $client->company_id;
            $client->update($data);
            return response()->json([
                'masssege' => 'client updated successfully',
                'client' => $client
            ], 200);
        } else {
            return response()->json('no found client');
        }
    }


    public function destroy($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return response()->json([
                'status' => 'Error',
                'status_code'=>ResponseAlias::HTTP_NOT_FOUND,
                'en' => 'not found this $id ',
                'ar' => 'هذا غير موجود',
                'data'=>[]
            ], ResponseAlias::HTTP_NOT_FOUND);
        }
        $client->delete();
        return response()->json('deleted client successfully');
    }
}
