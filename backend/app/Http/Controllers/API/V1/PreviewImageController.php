<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\PreviewImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PreviewImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'hospital_id' => 'exists:hospitals,id',
            'images' => 'required|array',
        ]);
        $user = Auth::user();
        $newData = [];
        try {
            if (!$user->hasRole('admin')) {
                if ($user->hasRole('hospital')) {
                    foreach ($data['images'] as $image) {
                        $img = $image;
                        $ext = $img->getClientOriginalExtension();
                        $filename = time() . '.' . $ext;
                        $preview = PreviewImage::create([
                            'hospital_id' => $user->hospital->id,
                            'image_name' => $filename,
                        ]);
                        $img->move(public_path('/') . 'images/hospital' . $preview->hospital_id . '/preview/preview' . $preview->id, $filename);
                        $newData[] = $preview;
                    }
                    return response()->json(['success' => true, 'message' => 'Upload successfully', 'data' => $newData]);
                } else {
                    return response()->json(['success' => false, 'message' => 'You are unauthorized to upload images'], 433);
                }
            } else {
                return response()->json(['success' => false, 'message' => 'You are unauthorized to upload images'], 433);
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PreviewImage $previewImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PreviewImage $previewImage)
    {
        $data=$request->validate([
            'hospital_id'=>'exists:hospitals,id',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
        $user=Auth::user();
        $image=$request['image'];
        $ext=$image->getClientOriginalExtension();
        $filename=time().'.'.$ext;
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    $data['image_name']=$filename;
                    if($previewImage->hospital_id==$user->hospital->id){
                        if(File::exists(public_path('/').'images/hospital'.$previewImage->hospital_id.'/preview/preview'.$previewImage->id.'/'.$previewImage->image_name)){
                            File::delete(public_path('/').'images/hospital'.$previewImage->hospital_id.'/preview/preview'.$previewImage->id.'/'.$previewImage->image_name);
                        }
                        $previewImage->update($data);
                        $image->move(public_path('/').'images/hospital'.$previewImage->hospital_id.'/preview/preview'.$previewImage->id,$filename);
                        return response()->json(['success'=>true,'message'=>'Upload successfully','data'=>$data],200);
                    }else{
                        return response()->json(['success'=>false,'message'=>'You are unauthorized to upload images'],433);
                    }
                }else{
                    return response()->json(['success'=>false,'message'=>'You are unauthorized to upload images'],433);
                }
            }else{
                return response()->json(['success'=>false,'message'=>'You are unauthorized to upload images'],433);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],422);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PreviewImage $previewImage)
    {
        $user=Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    if ($user->hospital->id==$previewImage->hospital_id){
                        if (File::exists(public_path('/').'images/hospital'.$previewImage->hospital_id.'/preview/preview'.$previewImage->id.'/'.$previewImage->image_name)){
                            File::deleteDirectory(public_path('/').'images/hospital'.$previewImage->hospital_id.'/preview/preview'.$previewImage->id);
                        }
                        $previewImage->delete();
                        return response()->json(['success'=>true,'message'=>'Deleted successfully'],200);
                    }else{
                        return response()->json(['success'=>false,'message'=>'You are unauthorized to delete images'],433);
                    }
                }else{
                    return response()->json(['success'=>false,'message'=>'You are unauthorized to delete images'],433);
                }
            }else{
                return response()->json(['success'=>false,'message'=>'You are unauthorized to delete images'],433);
            }
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],422);
        }
    }
}
