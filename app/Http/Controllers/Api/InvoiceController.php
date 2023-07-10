<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\InvoiceNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class InvoiceController extends Controller
{
    use ImageTrait;

    public function index()
    {
        $invoices = Invoice::with('client', 'items','company','tax','signature','paymentschedule')->get();
        return response()->json([
            'invoices' => $invoices
        ]);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $data['title'] = $request->title;
        $data['issued_date'] = $request->issued_date;
        $data['due_date'] = $request->due_date;
        $data['payment'] = $request->payment;
        $data['message'] = $request->message;
        $data['subtotal'] = $request->subtotal;
        $data['total'] = $request->total;
        $data['payment_due'] = $request->payment_due;
        $data['status'] = $request->status;
        $data['tax_id'] = $request->tax_id;
        $data['paymentSchedule_id'] = $request->paymentSchedule_id;
        $data['signature_id'] = $request->signature_id;
        $data['request_id'] = $request->request_id;
        $data['company_id'] = $request->company_id;
        $data['discount_id'] = $request->discount_id;
        $data['client_id'] = $request->client_id;

        $invoices = Invoice::create($data);
        if ($request->hasfile('image')) {
            $invoices_image = $this->saveImage($request->image, 'attachments/invoices/'.$invoices->id);
            $invoices->image = $invoices_image;
            $invoices->save();
        }

        $users=User::where('id','!=',auth()->user()->id)->get();
        $user_create=auth()->user()->name;
        Notification::send($users,new InvoiceNotification($invoices->id,$user_create,$request->title));

        return response()->json([
            'status' => true,
            'date' => $invoices,
            'message' => 'invoices Information Added Successfully',
        ]);

    }


    public function update(StoreInvoiceRequest $request, $id)
    {
        $invoices = Invoice::find($id);
        if ($invoices) {
            $data['title'] = $request->title;
            $data['issued_date'] = $request->issued_date;
            $data['due_date'] = $request->due_date;
            $data['payment'] = $request->payment;
            $data['message'] = $request->message;
            $data['subtotal'] = $request->subtotal;
            $data['total'] = $request->total;
            $data['payment_due'] = $request->payment_due;
            $data['status'] = $request->status;
            $data['tax_id'] = $request->tax_id;
            $data['paymentSchedule_id'] = $request->paymentSchedule_id;
            $data['signature_id'] = $request->signature_id;
            $data['request_id'] = $request->request_id;
            $data['company_id'] = $request->company_id;
            $data['discount_id'] = $request->discount_id;
            $data['client_id'] = $request->client_id;

            $invoices->update($data);
            if ($request->hasfile('image')) {
                $this->deleteFile('invoices',$id);
                $invoices_image = $this->saveImage($request->image, 'attachments/invoices/'.$id);
                $invoices->image = $invoices_image;
                $invoices->save();
            }
            return response()->json([
                'status' => true,
                'data' => $invoices,
                'message' => 'Invoices Information Updated Successfully',
            ]);
        }else{
            return response()->json([
                'status' => false,
                'data' => [],
                'message' => 'Not Found Id',
            ],502);
        }
    }

    public function show($id)
    {
        $invoice = Invoice::with('client','items')->find($id);
        if (!$invoice) {
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        return response()->json([
            'profession' => $invoice
        ], 200);
    }

    public function destroy($id)
    {
        $invoice = Invoice::find($id);
        if (!$invoice) {
            return response()->json([
                'status' => false,
                'message' => 'not found id',
            ],502);
        }
        $this->deleteFile('invoices', $id);
        $invoice->delete();
        Invoice::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Invoices Information deleted Successfully',
        ]);
    }

}
