<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\SubscribePayment;
use Illuminate\Http\Request;
use Stripe\Stripe;

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
        //
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
