<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Models\Quote;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes =Quote::all();
        return response()->json($quotes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuoteRequest $request)
    {
        $data['title'] = $request->title ;
        $data['message' ] = $request->message ;
        $data['subtotal'] = $request->subtotal ;
        $data['discount'] = $request->discount ;
        $data['type_discount'] = $request->type_discount ;
        $data['tax_name'] = $request->tax_name ;
        $data['tax_describe'] = $request->tax_describe ;
        $data['tax_rate'] = $request->tax_rate ;
        $data['total'] = $request->total ;
        $data['note'] = $request->note ;
        $data['company_id'] = $request->company_id ;
        $data['client_id'] = $request->client_id ;

        $quote = Quote::create($data);
        return response()->json([
            'status'=>true,
            'date' =>$quote,
            'message' => 'quote  Added Successfully',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $quote = Quote::findOrFail($request->id);
        return response()->json($quote);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuoteRequest $request, $id)
    {
        $quote = Quote::findOrFail($id);
        if($quote)
        {
            $data['title'] = $request->title ? $request->title  : $quote->title  ;
            $data['message' ] = $request->message ? $request->message : $quote->message;
            $data['subtotal'] = $request->subtotal ? $request->subtotal : $quote->subtotal  ;
            $data['discount'] = $request->discount ? $request->discount : $quote->discount;
            $data['type_discount'] = $request->type_discount ? $request->type_discount :$quote->type_discount ;
            $data['tax_name'] = $request->tax_name ? $request->tax_name : $quote->tax_name ;
            $data['tax_describe'] = $request->tax_describe ? $request->tax_describe : $quote->tax_describe ;
            $data['tax_rate'] = $request->tax_rate ? $request->tax_rate : $quote->tax_rate ;
            $data['total'] = $request->total ? $request->total : $quote->total  ;
            $data['note'] = $request->note ? $request->note : $quote->note;
            $data['company_id'] = $request->company_id ? $request->company_id : $quote->company_id;
            $data['client_id'] = $request->client_id ? $request->client_id : $quote->client_id ;

            $quote->update($data);
            return response()->json([
                'status'=>true,
                'date' =>$quote,
                'message' => 'Quote  Update Successfully',
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
            $quote= Quote::where('id',$request->id)->delete();

            if ($quote)
            {
                return response()->json([
                    'status'=>true,
                    'message' => 'Quote deleted Successfully',
                ]);
            } else
            {
                return response()->json([
                    'status'=>false,
                    'message' => ' Error Qoute Not deleted ',
                ]);
        }

    }
}