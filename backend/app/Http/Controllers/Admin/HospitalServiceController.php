<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\HospitalService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HospitalServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return HospitalService::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $data=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'hospital_id'=>'required|exists:App\Models\Hospital,id',
        ]);
        $hospital_id=$user->hospital->id;
        $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $filename=time().'.'.$ext;
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    $data['hospital_id']=$hospital_id;
                    $data['image']=$filename;
                    $service=HospitalService::create($data);
                    $image->move(public_path('/').'images/hospital'.$service->hospital_id.'/service'.$service->id, $filename);
                    return response()->json(['success'=>true,'message'=>'Service added successfully.']);
                }else{
                    return response()->json(['message'=>'You are not authorized to access this page'],403);
                }
            }else{
                return response()->json(['message'=>'You are not authorized to access this page'],403);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalService $hospitalService)
    {
        try {
            return response()->json(['success'=>true,'message'=>'service retrieved successfully','data'=>$hospitalService],200);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],422);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HospitalService $hospitalService)
    {
        $user=Auth::user();
        $data=$request->validate([
            'name'=>'required',
            'description'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'hospital_id'=>'required|exists:App\Models\Hospital,id',
        ]);
        $hospital_id=$user->hospital->id;
        $image=$request->file('image');
        $ext=$image->getClientOriginalExtension();
        $filename=time().'.'.$ext;
        try {
            if(File::exists(public_path('/').'images/hospital'.$hospitalService->hospital_id.'/service'.$hospitalService->id.'/'.$hospitalService->image)){
                File::delete(public_path('/').'images/hospital'.$hospitalService->hospital_id.'/service'.$hospitalService->id.'/'.$hospitalService->image);
            }
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    $data['hospital_id']=$hospital_id;
                    $data['image']=$filename;
                    $hospitalService->update($data);
                    $image->move(public_path('/').'images/hospital'.$hospitalService->hospital_id.'/service'.$hospitalService->id,$filename);
                    return response()->json(['success'=>true,'message'=>'Service updated successfully.']);
                }else{
                    return response()->json(['message'=>'You are not authorized to access this page'],403);
                }
            }else{
                return response()->json(['message'=>'You are not authorized to access this page'],403);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalService $hospitalService)
    {
        $user=Auth::user();
        $hospital_id=$user->hospital->id;
        try {
            if (!$user->hasRole('admin')) {
                if($user->hasRole('hospital')) {
                    if(File::exists(public_path('/').'images/hospital'.$hospitalService->hospital_id.'/service'.$hospitalService->id.'/'.$hospitalService->image)){
                        File::delete(public_path('/').'images/hospital'.$hospitalService->hospital_id.'/service'.$hospitalService->id.'/'.$hospitalService->image);
                    }
                    if($hospitalService->hospital_id==$hospital_id){
                        $hospitalService->delete();
                    }
                    return response()->json(['success'=>true,'message'=>'Service deleted successfully.']);
                }else{
                    return response()->json(['message'=>'You are not authorized to access this page'],403);
                }
            }else{
                return response()->json(['message'=>'You are not authorized to access this page'],403);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],422);
        }
    }
}
