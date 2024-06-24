<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{

    function __construct()
    {
        $this->middleware('role_or_permission:Hospital access|Hospital create|Hospital edit|Hospital delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Hospital create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Hospital edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Hospital delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::latest()->get();
        return view('setting.hospital.index', compact('hospitals'));
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
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hospital $hospital)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        //
    }
}
