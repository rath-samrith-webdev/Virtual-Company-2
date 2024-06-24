<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success'=>true,"appointments"=>Appointment::all()],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
        ]);
        $data['user_id'] = Auth::id();
        try {
            Appointment::create($data);
            return response()->json(['success'=>true,"appointments"=>Appointment::all()],201);
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
            return response()->json(['success'=>true,"appointments"=>Appointment::all()],200);
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
        ]);
        $data['user_id'] = Auth::id();
        try {
            if($appointment->hospital_id==$data['hospital_id'] && $appointment->user_id==$data['user_id']){
                $appointment->update($data);
                return response()->json(['success'=>true,"appointments"=>Appointment::all()],200);
            }else{
                return response()->json(['success'=>false],500);
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
                return response()->json(['success'=>true,"appointments"=>Appointment::all()],200);
            }else{
                return response()->json(['success'=>false],500);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],500);
        }
    }
}
