<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;

class PaypalController extends Controller
{
    public function payment(){
        $data =[];
        $data['items']=[
            [
                'name'=>'Subscribe to Site',
                'price'=>600,
                'desc'=>'Description',
                'qty'=>4,
            ]
            ,[
                'name'=>'subscribe to channel',
                'price'=>300,
                'desc'=>'Description',
                'qty'=>2,
            ]
        ];
        $data['invoice_id']=1;
        $data['invoice_description']="Order #{$data['invoice_id']}Invoice";
        $data['return_url']='http://127.0.0.1:8000/payment/success';
        $data['cancel_url']='http://127.0.0.1:8000/cancel';
        $data['total']=3000; #$request->price * $request->quantity

        $providers=new ExpressCheckout;
        $response=$providers->setExpressCheckout($data,true);
        return redirect($response['paypal_link']);

    }
    public function cancel(){
        return response()->json('canceled',402);
    }
    public function success(Request $request){
        $providers=new ExpressCheckout;
        $response = $providers->getExpressCheckoutDetails($request->token);
        if(in_array(strtoupper($response['ACK']), ['SUCCESS','SUCCESSWITHWARNING'])){
            return response()->json('paid success');
        }
        return response()->json('faild payment',402);
    }
}
