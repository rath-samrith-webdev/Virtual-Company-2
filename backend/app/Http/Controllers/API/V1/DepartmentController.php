<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return response()->json(['success' => true, 'data' => Department::all()],200);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()],500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string',
            'details'=>'required|string'
        ]);
        $user=Auth::user();
        $hospital_id=$user->hospital->id;
        $data['hospital_id']=$hospital_id;
        try {
            $department=Department::create($data);
            return response()->json(['success' => true,'data'=>$department],200);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()],500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        try {
            return response()->json(['success' => true, 'data' => $department],200);
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()],500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $data=$request->validate([
            'name'=>'required|string',
            'details'=>'required|string'
        ]);
        $user=Auth::user();
        $hospital=$user->hospital;
        try {
            if($department->hospital_id==$hospital->id){
                $department->update($data);
                return response()->json(['success' => true,'data'=>$department],200);
            }else{
                return response()->json(['success' => false,'message'=>'Hospital not found'],500);
            }
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()],500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $user=Auth::user();
        $hospital=$user->hospital;
        try {
            if($department->hospital_id==$hospital->id){
                $department->delete();
                return response()->json(['success' => true,'data'=>$department],200);
            }else{
                return response()->json(['success' => false,'message'=>'Hospital not found'],500);
            }
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()],500);
        }

    }
}
