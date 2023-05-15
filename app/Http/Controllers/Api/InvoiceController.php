<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    //

    public function index()
    {
        $invoices = Invoice::with('client', 'items')->get();
        return response()->json([
            'invoices' => $invoices
        ], 200);
    }

    public function store(StoreInvoiceRequest $request)
    {
        $data['client_id'] = $request->client_id;
        $data['title'] = $request->title;
        $data['issued_date'] = $request->issued_date;
        $data['due_date'] = $request->due_date;
        $data['payment'] = $request->payment;
        $data['message'] = $request->message;
        $data['subtotal'] = $request->subtotal;
        $data['discount'] = $request->discount;
        $data['type_discount'] = $request->type_discount;
        $data['tax_name'] = $request->tax_name;
        $data['tax_desribe'] = $request->tax_desribe;
        $data['tax_rate'] = $request->tax_rate;
        $data['total'] = $request->total;
        $data['company_id'] = $request->company_id;

        $invoices = Invoice::create($data);
        return response()->json([
            'status' => true,
            'date' => $invoices,
            'message' => 'invoices Information Added Successfully',
        ]);

    }


    public function update(UpdateInvoiceRequest $request, $id)
    {
        $invoices = Invoice::findOrFail($id);
        if ($invoices) {
            $data['client'] = $request->client ? $request->client : $invoices->client;
            $data['title'] = $request->title ? $request->title : $invoices->title;
            $data['issued_date'] = $request->issued_date ? $request->issued_date : $invoices->issued_date;
            $data['due_date'] = $request->due_date ? $request->due_date : $invoices->due_date;
            $data['payment'] = $request->payment;
            $data['message'] = $request->message;
            $data['subtotal'] = $request->subtotal;
            $data['discount'] = $request->discount;
            $data['type_discount'] = $request->type_discount;
            $data['tax_name'] = $request->tax_name ? $request->tax_name : $invoices->tax_name;
            $data['tax_desribe'] = $request->tax_desribe;
            $data['tax_rate'] = $request->tax_rate ? $request->tax_rate : $invoices->tax_rate;
            $data['total'] = $request->total ? $request->total : $invoices->total;
            $data['company_id'] = $request->company_id ? $request->company_id : $invoices->company_id;
            $data['client_id'] = $request->client_id ? $request->client_id : $invoices->client_id;

            $invoices->update($data);
            return response()->json([
                'status' => true,
                'data' => $invoices,
                'message' => 'invoices Information Updated Successfully',
            ]);
        }
    }

    public function show($id)
    {
        $invoices = Invoice::with('client', 'items')->find($id);
        return response()->json($invoices);
    }

    public function destroy(Request $request, $id)
    {
        Invoice::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'invoices Information deleted Successfully',
        ]);
    }

}
