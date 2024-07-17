<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\AppointmentNotifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentNotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    $hospital=$user->hospital;
                    $data=$hospital->user->notifications()->get();
                }elseif ($user->hasRole('doctor')){
                    $doctor=$user->doctor;
                    $data=$doctor->user->notifications()->get();
                }else{
                    $data=$user->notifications()->get();
                }
                return response()->json(['success'=>true,'data'=>$data], 200);
            }else{
                return response()->json(['success'=>true,'data'=>AppointmentNotifications::all()],200);
            }
        }catch (\Exception $e){
            return response()->json(['error'=>true,"message"=>"Server error"], 500);
        }
    }
    public function unread()
    {
        $user=Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    $hospital=$user->hospital;
                    $data=$hospital->user->notifications()->where('is_read',false)->get();
                }elseif ($user->hasRole('doctor')){
                    $doctor=$user->doctor;
                    $data=$doctor->user->notifications()->where('is_read',false)->get();
                }else{
                    $data=$user->notifications()->where('is_read',false)->get();
                }
                return response()->json(['success'=>true,'data'=>$data], 200);
            }else{
                return response()->json(['success'=>true,'data'=>AppointmentNotifications::where('is_read',false)->get()],200);
            }
        }catch (\Exception $e){
            return response()->json(['error'=>true,"message"=>"Server error"], 500);
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
    public function show(AppointmentNotifications $appointmentNotification)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AppointmentNotifications $appointmentNotification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentNotifications $appointmentNotification)
    {
        //
    }
}
