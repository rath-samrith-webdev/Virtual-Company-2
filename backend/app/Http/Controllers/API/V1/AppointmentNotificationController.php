<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\DoctorNotificationResource;
use App\Http\Resources\V1\HospitalNotificationResource;
use App\Http\Resources\V1\UserNotificationResource;
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
                $data=$user->notifications()->get();
                if($user->hasRole('hospital')){
                    return response()->json(['success'=>true,'message'=>'notification retrieved','data'=>HospitalNotificationResource::collection($data)], 200);
                }elseif ($user->hasRole('doctor')){
                    return response()->json(['success'=>true,'message'=>'notification retrieved','data'=>DoctorNotificationResource::collection($data)], 200);
                }else{
                    return response()->json(['success'=>true,'message'=>'notification retrieved','data'=>UserNotificationResource::collection($data)], 200);
                }
            }else{
                return response()->json(['success'=>true,'data'=>AppointmentNotifications::all()],200);
            }
        }catch (\Exception $e){
            return response()->json(['error'=>true,"message"=>"Server error",'data'=>$e->getMessage()], 500);
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
    public function markAsSeen(AppointmentNotifications $appointmentNotification)
    {
        $user=Auth::user();
        try {
            if($user->hasRole('admin')){
                $appointmentNotification->update(['is_read'=>1]);
            }elseif($user->hasRole('hospital')){
                if ($appointmentNotification->user_id==$user->hospital->user_id){
                    $appointmentNotification->update(['is_read'=>1]);
                }
            }elseif ($user->hasRole('doctor')){
                if($user->doctor->user_id==$appointmentNotification->user_id){
                    $appointmentNotification->update(['is_read'=>1]);
                }
            }else{
                if($user->id==$appointmentNotification->user_id){
                    $appointmentNotification->update(['is_read'=>1]);
                }else{
                    return response()->json(['success'=>false,'message'=>'Unauthorized'], 401);
                }
            }
            return response()->json(['data'=>$appointmentNotification]);
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
