<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Requests\UpdateQuoteRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Quote;
use App\Models\User;
use App\Notifications\QuoteNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class QuoteController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $quotes = Quote::all();
        return response()->json([
            'quotes' => $quotes
        ], 200);
    }
    public function store(StoreQuoteRequest $request)
    {
        $data['title'] = $request->title;
        $data['message'] = $request->message;
        $data['subtotal'] = $request->subtotal;
        $data['offer_price_massage'] = $request->offer_price_massage;
        $data['total'] = $request->total;
        $data['date'] = $request->date;
        $data['note'] = $request->note;
        $data['status'] = $request->status;
        $data['paymentSchedule_id'] = $request->paymentSchedule_id;
        $data['discount_id'] = $request->discount_id;
        $data['item_id'] = $request->item_id;
        $data['company_id'] = $request->company_id;
        $data['client_id'] = $request->client_id;
        $data['signature_id'] = $request->signature_id;
        $data['tax_id'] = $request->tax_id;
        $quote = Quote::create($data);
        if ($request->hasfile('image')) {
            $quote_image = $this->saveImage($request->image, 'attachments/quote/'.$quote->id);
            $quote->image = $quote_image;
            $quote->save();
        }
        $users=User::where('id','!=',auth()->user()->id)->get();
        $user_create=auth()->user()->name;
        Notification::send($users,new QuoteNotification($quote->id,$user_create,$request->title));

        return response()->json([
            'status' => true,
            'date' => $quote,
            'message' => 'quote  Added Successfully',
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $quote = Quote::find($id);
        if(!$quote){
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        return response()->json([
            'quote' => $quote
        ]);
    }

    public function update(StoreQuoteRequest $request, $id)
    {
        $quote = Quote::find($id);
        if ($quote) {
            $data['title'] = $request->title;
            $data['message'] = $request->message;
            $data['subtotal'] = $request->subtotal;
            $data['offer_price_massage'] = $request->offer_price_massage;
            $data['total'] = $request->total;
            $data['date'] = $request->date;
            $data['note'] = $request->note;
            $data['status'] = $request->status;
            $data['paymentSchedule_id'] = $request->paymentSchedule_id;
            $data['discount_id'] = $request->discount_id;
            $data['item_id'] = $request->item_id;
            $data['company_id'] = $request->company_id;
            $data['client_id'] = $request->client_id;
            $data['signature_id'] = $request->signature_id;
            $data['tax_id'] = $request->tax_id;
            $quote->update($data);
            if ($request->hasfile('image')) {
                $this->deleteFile('quote', $id);
                $quote_image = $this->saveImage($request->image, 'attachments/quote/'.$id);
                $quote->image = $quote_image;
                $quote->save();
            }
            return response()->json([
                'status' => true,
                'date' => $quote,
                'message' => 'Quote  Update Successfully',
            ],201);
        }else{
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }

    }

    public function destroy($id)
    {
        $Quote = Quote::find($id);
        if (!$Quote) {
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        $this->deleteFile('quote', $id);
        $Quote->delete();
        Quote::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Quotes Information deleted Successfully',
        ]);

    }
}
