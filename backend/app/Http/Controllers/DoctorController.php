<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Comment\Doc;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(['success' => true, 'data' => Doctor::all()]);
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'hospital_id'=>'required|exists:hospitals,id',
            'name'=>'required',
            'email'=>'required|email|unique:doctors,email',
            'phone'=>'required|unique:doctors,phone',
        ]);
        $user = Auth::user();
        $hospial=$user->hospital;
        try {
            if ($hospial->id==$data['hospital_id']) {
                $doctor=Doctor::create($data);
                return response()->json(['success' => true, 'data' => $doctor],201);
            }else{
                return response()->json(['success' => false, 'message' => 'Hospital not found'],404);
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()],404);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        $user=Auth::user();
        $hospital=$user->hospital;
        try {
            if($hospital->id==$doctor->hospital_id){
                return response()->json(['success' => true, 'data' => $doctor],201);
            }else{
                return response()->json(['success' => false, 'message' => 'Hospital not found'],404);
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $data=$request->validate([
            'hospital_id'=>'required|exists:hospitals,id',
            'name'=>'required',
        ]);
        $user = Auth::user();
        $hospital=$user->hospital;
        try {
            if ($hospital->id==$data['hospital_id']) {
                $doctor=$doctor->update($data);
                return response()->json(['success' => true, 'data' => $doctor],201);
            }else{
                return response()->json(['success' => false, 'message' => 'Hospital not found'],404);
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()],404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        $user = Auth::user();
        $hospital=$user->hospital;
        try {
            if($doctor->hospital_id==$hospital->id) {
                $doctor = $doctor->delete();
                return response()->json(['success' => true, 'data' => $doctor], 201);
            }else{
                return response()->json(['success' => false, 'message' => 'Hospital not found'],404);
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()],404);
        }
    }
}
