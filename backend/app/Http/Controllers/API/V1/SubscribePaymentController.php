<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\SubscribePayment;
use App\Models\SubscribePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe;

class SubscribePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SubscribePayment::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'number'=>'required|regex:/^\d+$/',
            'exp_month'=>'required|regex:/^\d+$/',
            'exp_year'=>'required|regex:/^\d+$/',
            'cvc'=>'required|regex:/^\d+$/',
            'amount'=>'required|regex:/^\d+$/',
            'currency'=>'required|string',
            'subscribe_plan_id'=>'required|exists:subscribe_plans,id',
        ]);
        $user=Auth::user();
        $plan=SubscribePlan::find($data['subscribe_plan_id']);
        try {
            if(!$user->hasRole('admin')){
                if ($user->hasRole('hospital')){
                    $stripe=new \Stripe\StripeClient(env('STRIPE_SK'));
                    \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
                    $data['amount']=$plan->price;
                    $response=$stripe->paymentIntents->create([
                        'amount' => $data['amount']*100,
                        'currency' => $data['currency'],
                        'payment_method' => 'pm_card_visa',
                        'payment_method_types' => ['card'],
                    ]);
                    $confirm=$stripe->paymentIntents->confirm(
                        $response->id, [
                        'payment_method' => 'pm_card_visa',
                        'return_url' => 'http://localhost:8000/subscribe',
                    ]);
                    $pay=SubscribePayment::create([
                        'name'=>$user->first_name. ' '. $user->last_name,
                        'payment_id'=>$response->id,
                        'payment_method' => 'pm_card_visa',
                        'payment_types' => 'card',
                        'user_id'=>$user->id,
                        'amount'=>$data['amount'],
                        'subscribe_plan_id'=>$data['subscribe_plan_id'],
                    ]);
                    return response()->json(['success'=>true,'message'=>'payment successful','data'=>$pay],200);
                }
            }
        }catch (\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscribePayment $subscribePayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscribePayment $subscribePayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribePayment $subscribePayment)
    {
        //
    }
}
