<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Http\Resources\V1\DepartmentResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        try{
            if($user->hasRole('admin')){
                $department=Department::all();
            }elseif($user->hasRole('hospital')){
                $department=$user->hospital->departments()->get();
            }else{
                return response()->json(['success'=>true,'message'=>'You have no access'],443);
            }
            return response()->json(['success'=>true,'message'=>'Resquest successful','data'=>DepartmentResource::collection($department)]);
        }catch(\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string',
            'details'=>'required|string',
            'image'=>'image|mimes:jpeg,jpg,png'
        ]);
        $user=Auth::user();
        $hospital_id=$user->hospital->id;
        $data['hospital_id']=$hospital_id;
        $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $filename=time().'.'.$ext;
        try {
            if($user->hasRole('admin')){
                $data['image']=$filename;
                $department=Department::create($data);
                $image->move(public_path('/').'images/hospital'.$department->hospital_id.'/department'.$department->id, $filename);
                return response()->json(['success' => true,'data'=>$department],201);
            }elseif ($user->hasRole('hospital')) {
                $data['hospital_id']=$hospital_id;
                $data['image']=$filename;
                $department=Department::create($data);
                $image->move(public_path('/').'images/hospital'.$department->hospital_id.'/department'.$department->id, $filename);
                return response()->json(['success' => true,'data'=>$department],201);
            }else{
                return response()->json(['success'=>false,'message'=>'You have no access'],443);
            }
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
            'details'=>'required|string',
            'image'=>'image|mimes:jpeg,jpg,png'
        ]);
        $user=Auth::user();
        $hospital=$user->hospital;
        $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $filename=time().'.'.$ext;
        try {
            if(!$user->hasRole('admin')){
                if ($user->hasRole('hospital')) {
                    if($department->hospital_id==$hospital->id){
                        if(File::exists(public_path('/').'images/hospital'.$department->hospital_id.'/department'.$department->id.'/'.$department->image)){
                            File::delete(public_path('/').'images/hospital'.$department->hospital_id.'/department'.$department->id.'/'.$department->image);
                        }
                        $data['image']=$filename;
                        $department->update($data);
                        $image->move(public_path('/').'images/hospital'.$department->hospital_id.'/department'.$department->id, $filename);
                        return response()->json(['success' => true,'data'=>$department],200);
                    }else{
                        return response()->json(['success' => false,'message'=>'You are not authorized'],443);
                    }
                }
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
            if(!$user->hasRole('admin')){
                if ($user->hasRole('hospital')) {
                    if($department->hospital_id==$hospital->id){
                        if(File::exists(public_path('/').'images/hospital'.$department->hospital_id.'/department'.$department->id.'/'.$department->image)){
                            File::deleteDirectory(public_path('/').'images/hospital'.$department->hospital_id.'/department'.$department->id);
                        }
                        $department->delete();
                        return response()->json(['success' => true,'message'=>'Department successfully removed'],200);
                    }else{
                        return response()->json(['success' => false,'message'=>'You are not authorized'],443);
                    }
                }else{
                    return response()->json(['success' => false,'message'=>'You are not authorized'],443);
                }
            }
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()],500);
        }

    }
}
