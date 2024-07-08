<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\DoctorDetails;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(['success' => true, 'data' => DoctorDetails::collection(Doctor::all())], 200);
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
            'first_name'=>'required',
            'last_name'=>'required',
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required',
            'hospital_id'=>'required|exists:hospitals,id',
        ]);
        $user = Auth::user();
        $hospial=$user->hospital;
        try {
            if ($hospial->id==$data['hospital_id']) {
                $newUser=User::create([
                    'first_name'=>$data['first_name'],
                    'last_name'=>$data['last_name'],
                    'name'=>$data['name'],
                    'email'=>$data['email'],
                    'password'=>bcrypt($data['password']),
                ]);
                $newUser->assignRole('doctor');
                $uid=$newUser->id;
                $doctor=Doctor::create([
                    'hospital_id'=>$data['hospital_id'],
                    'user_id'=>$uid,
                ]);
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
