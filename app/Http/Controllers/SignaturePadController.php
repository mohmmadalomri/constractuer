<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Company;
use App\Models\Signature;
use Illuminate\Http\Request;

class SignaturePadController extends Controller
{
    public function index()
    {
        $clients=Client::all();
        return view('signature-pad', compact('clients'));
    }
    public function index_company()
    {
        $companies=Company::all();
        return view('signature-pad_company', compact('companies'));
    }
    public function store(Request $request)
    {
        $folderPath = public_path('attachments/signature/');

        $image_parts = explode(";base64,", $request->signed);

        $image_type_aux = explode("image/", $image_parts[0]);

        $image_type = $image_type_aux[1];

        $image_base64 = base64_decode($image_parts[1]);

        $signature = uniqid() . '.'.$image_type;

        $file = $folderPath . $signature;

        file_put_contents($file, $image_base64);

        $save = new Signature;
        $save->company_id = $request->company_id;
        $save->client_id = $request->client_id;
        $save->signature = $signature;
        $save->save();


        return back()->with('success', 'Form successfully submitted with signature');
    }
    public function signature_client_show_all(){
        $signatures=Signature::where('client_id','!=',null)->get();
        $requestWithUrls = $signatures->map(function ($signature) {
            $signature->signature = url('attachments/signature/'. $signature->signature);
            return $signature;
        });
            return response()->json([
                'status'=>true,
                'message'=>'client',
                'data'=>$requestWithUrls
            ]);
    }
    public function signature_company_show_all(){
        $signatures=Signature::where('company_id','!=',null)->get();
        $requestWithUrls = $signatures->map(function ($signature) {
            $signature->signature = url('attachments/signature/'. $signature->signature);
            return $signature;
        });
        return response()->json([
            'status'=>true,
            'message'=>'company',
            'data'=>$requestWithUrls
        ]);
    }
//    public function signature_client_show_id($id){
//        $signature=Signature::where('client_id','!=',null)->find($id);
//        $signature->signature = url('attachments/signature/'. $signature->signature);
//        return response()->json([
//            'status'=>true,
//            'data'=>$signature
//        ]);
//    }
}
