<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscribePayment;
use Illuminate\Http\Request;

class SubscribePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SubscribePayment::all();
        return view('setting.subscribePayment.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribePayment $subscribePayment)
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
