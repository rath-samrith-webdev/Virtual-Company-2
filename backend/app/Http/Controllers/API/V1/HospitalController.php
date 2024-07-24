<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\HospitalResource;
use App\Models\Hospital;
use App\Models\PreviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success' => true, 'data' => HospitalResource::collection(Hospital::all())], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $uid = Auth::id();
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'street_address' => 'string',
            'village' => 'string',
            'commune'=>'string',
            'district' => 'string',
            'province' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
            'open_time' => 'date_format:H:i',
            'close_time' => 'date_format:H:i',
            'mission'=>'string',
            'vision'=>'string'
        ]);
        $data['user_id'] = $uid;
        $existHospital=Hospital::where('user_id',$uid)->first();
        try {
            if(!$existHospital){
                $hospital = Hospital::create($data);
                return response()->json(['success' => true, 'data' => HospitalResource::make($hospital)], 201);
            }else{
                return response()->json(['success' => false, 'message' => 'Hospital already exist'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        return response()->json(['success' => true, 'data' => new HospitalResource($hospital)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {
        $uid = Auth::id();
        $data = $request->validate([
            'name' => 'required',
            'category_id' => 'exists:categories,id',
            'street_address' => 'string',
            'village' => 'string',
            'commune' => 'string',
            'district' => 'string',
            'province' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i',
            'mission'=>'string',
            'vision'=>'string'
        ]);
        try {
            if ($hospital->user_id == $uid) {
                $hospital->update($data);
                return response()->json(['success' => true, 'data' => $hospital], 201);
            } else {
                return response()->json(['success' => false, 'message' => 'You are not authorized to access this page.'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        $uid = Auth::id();
        try {
            if ($hospital->user_id == $uid) {
                $hospital->delete();
                return response()->json(['success' => true, 'message' => 'Hospital has been deleted', 'data' => $hospital], 201);
            } else {
                return response()->json(['success' => false, 'message' => 'You can not delete this!'], 500);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function uploadPreviewImage(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
        try {
            if (!$user->hasRole('admin')){
                if(!$user->hasRole('hospital')){
                    $hospital = $user->hospital;
                    if ($hospital) {
                        $image->move(public_path('/') . '/images/hospital/hospital-' . $hospital->id . '/', $filename);
                        PreviewImage::create([
                            'hospital_id' => $hospital->id,
                            'image_name' => $filename,
                        ]);
                        return response()->json(['success' => true, 'message' => 'Preview image has been created', 'data' => $hospital], 201);
                    } else {
                        return $filename;
                    }
                }else{
                    return response()->json(['success' => false, 'message' => 'You are not authorized to access this page.'], 401);
                }
            }
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    public function uploadCover(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'hospital_id' => 'required|integer|exists:hospitals,id',
        ]);
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        try {
            if(!$user->hasRole('admin')){
               if($user->hasRole('hospital')){
                   $hospital = Hospital::where('id', $request['hospital_id'])->first();
                   $filename = 'hospital-' . $hospital->id . '-' . time() . '.' . $extension;
                   $path = public_path('/') . '/images/hospital'.$hospital->id.'/hospital-cover/hospital-' . $hospital->id . '/' . $hospital->cover_image;
                   if (File::exists($path)) {
                       File::delete($path);
                   }
                   $hospital->update(['cover_image' => $filename]);
                   $image->move(public_path('/') . '/images/hospital'.$hospital->id .'/hospital-cover/hospital-' . $hospital->id . '/', $filename);
                   return response()->json(['success' => true, 'message' => 'Cover image has been uploaded', 'data' => $hospital], 201);
               }else{
                   return response()->json(['success' => false, 'message' => 'You are not authorized to access this page.'], 401);
               }
            }else{
                return response()->json(['success' => false, 'message' => 'You are not authorized to access this page.'], 401);
            }

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Upload Error', 'error' => $e->getMessage()], 500);
        }

    }
}
