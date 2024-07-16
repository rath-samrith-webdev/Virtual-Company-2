<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Notifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoficationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        try{
            if($user->hasRole('admin')){
                $data=Notifications::all();
            }elseif($user->hasRole('hospital')){
                $data=$user->notifications()->where('type','New Appointment')->get();
            }elseif($user->hasRole('doctor')){
                $data=$user->notifications()->where('type','New Appointment')->get();
            }else{
                $data=$user->notifications()->get();
            }
        }
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
    public function show(Notifications $nofications)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notifications $nofications)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notifications $nofications)
    {
        //
    }
}
