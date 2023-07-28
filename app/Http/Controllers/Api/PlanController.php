<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function createPlanInDatabase(Request $request)
    {
        // Get the plan details from the request or PayPal API response
        $planId = $request->input('plan_id');
        $name = $request->input('name');
        $description = $request->input('description');
        $type = $request->input('type');
        $amount = $request->input('amount');
        $currency = $request->input('currency');

        // Save the plan details to the database
        $plan = new Plan();
        $plan->plan_id = $planId;
        $plan->name = $name;
        $plan->description = $description;
        $plan->type = $type;
        $plan->amount = $amount;
        $plan->currency = $currency;
        // Save other plan details if needed
        $plan->save();

        return response()->json([
            'status'=>true,
            'message' => 'Plan created successfully.',
            'data' => $plan
        ]);
    }




}
