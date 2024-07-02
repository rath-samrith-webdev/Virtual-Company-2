<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SystemRequest;
use Illuminate\Http\Request;

class SystemRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = SystemRequest::all();
        return view('system_request.index', compact('requests'));
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
    public function show(SystemRequest $systemRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SystemRequest $systemRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemRequest $systemRequest)
    {
        //
    }
}
