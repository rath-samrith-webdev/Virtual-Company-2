<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HospitalResource;
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
            'district' => 'string',
            'province' => 'string',
            'latitude' => 'string',
            'longitude' => 'string',
        ]);
        $data['user_id'] = $uid;
        try {
            $hospital = Hospital::create($data);
            return response()->json(['success' => true, 'data' => HospitalResource::make($hospital)], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        //
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
        $hospital = $user->hospital;
        $extension = $image->getClientOriginalExtension();
        $filename = time() . '.' . $extension;
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
            if ($user->hasRole('admin')) {
                $hospital = Hospital::where('id', $request['hospital_id'])->first();
            } elseif ($user->hasRole('hospital')) {
                $hospital = $user->hospital();
            } else {
                return false;
            }
            $filename = 'hospital-' . $hospital->id . '-' . time() . '.' . $extension;
            $path=public_path('/') . '/images/hospital/hospital-cover/hospital-' . $hospital->id . '/'.$hospital->cover_image;
            if(File::exists($path)) {
                File::delete($path);
            }
            $hospital->update(['cover_image' => $filename]);
            $image->move(public_path('/') . '/images/hospital/hospital-cover/hospital-' . $hospital->id . '/', $filename);
            return response()->json(['success' => true, 'message' => 'Cover image has been uploaded', 'data' => $hospital], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }


    }
}
