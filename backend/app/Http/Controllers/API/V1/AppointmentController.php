<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success'=>true,"data"=>AppointmentResource::collection(Appointment::all())],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'title'=>'required|string',
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time'=>'required|date_format:H:i',
        ]);
        $data['user_id'] = Auth::id();
        try {
            Appointment::create($data);
            return response()->json(['success'=>true,"data"=>AppointmentResource::collection(Appointment::all())],201);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        try {
            return response()->json(['success'=>true,"data"=>AppointmentResource::make($appointment)],200);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time'=>'required|date_format:H:i',
        ]);
        $user=Auth::user();
        try {
            if($user->hasRole('admin')){
                return response()-json(['success'=>false,'message'=>'You are not authorized to update appointment.'],403);
            }elseif($user->hasRole('hospital')){
                if($appointment->hospital_id==$data['hospital_id']) {
                    $appointment->update($data);
                    return response()->json(['success' => true, 'message' => 'Appointment updated successfully', "data" => Appointment::all()], 200);
                }else{
                    return response()->json(['success' => false, 'message' => 'You are not authorized to update appointment.'], 403);
                }
            }else{
                $data['user_id'] = Auth::id();
                $appointment->update($data);
                return response()->json(['success'=>true,'message'=>'Appointment updated successfully'],200);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            if($appointment->user_id==Auth::id()){
                $appointment->delete();
                return response()->json(['success'=>true,'message'=>'Appointment has been deleted'],200);
            }else{
                return response()->json(['success'=>false,'message'=>'Unauthorized'],500);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],500);
        }
    }
    public function updateAppointments(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status'=>'required|string',
        ]);
        $user=Auth::user();
        try {
            if($appointment->status!=='Canceled'){
                if($user->hasRole('admin')){
                    $appointment->update($data);
                }elseif ($user->hasRole('hospital')){
                    $appointment->update($data);
                }elseif($user->id==$appointment->user_id){
                    $appointment->update($data);
                }else{
                    return response()->json(['success'=>false,'message'=>'Unauthorized'],500);
                }
                return response()->json(['success'=>true,'message'=>'Appointments has been canceled successfully'],200);
            }else{
                return response()->json(['success'=>false,'message'=>'This Appointment has already been canceled'],200);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],500);
        }
    }
}
