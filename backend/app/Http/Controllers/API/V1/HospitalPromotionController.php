<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PromotionResource;
use App\Models\HospitalPromotions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HospitalPromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        try {
            if (!$user->hasRole('admin')) {
                if($user->hasRole('hospital')){
                    $data=$user->hospital->promotions()->get();
                    return response()->json(['success'=>true,'message'=>'Retrieved successful','data'=>PromotionResource::collection($data)],200);
                }else{
                    return response()->json(['success'=>false,'message'=>'You are not authorized'],403);
                }
            }else{
                return response()->json(['success'=>false,'message'=>'You are unauthorized'],433);
            }
        }catch (\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],433);
        }
    }
    public function promotionlist()
    {
        $data=HospitalPromotions::all();
        try {
            return response()->json(['success'=>true,'message'=>'Retrieved successful','data'=>PromotionResource::collection($data)],200);
        }catch (\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],433);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'hospital_id'=>'exists:App\Models\Hospital,id',
            'title'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description'=>'required|string',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
        ]);
        $image=$request->file('image');
        $extension=$image->getClientOriginalExtension();
        $filename=time().'.'.$extension;
        $user=Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    $data['hospital_id']=$user->hospital->id;
                    $data['image']=$filename;
                    $promotion=HospitalPromotions::create($data);
                    $image->move(public_path('/').'images/hospital'.$promotion->hospital_id.'/promotions/promotion'.$promotion->id, $filename);
                    return response()->json(['success'=>true,'message'=>'Promotion created successfully','data'=>$data],200);
                }else{
                    return response()->json(['success'=>false,'message'=>'You are unauthorized'],433);
                }
            }else{
                return response()->json(['success'=>false,'message'=>'You are unauthorized'],433);
            }
        }catch (\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],433);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HospitalPromotions $hospitalPromotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HospitalPromotions $hospitalPromotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HospitalPromotions $hospitalPromotion)
    {
        $data=$request->validate([
            'hospital_id'=>'exists:App\Models\Hospital,id',
            'title'=>'required|string',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg',
            'description'=>'required|string',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after:start_date',
        ]);
        $image=$request->file('image');
        $extension=$image->getClientOriginalExtension();
        $filename=time().'.'.$extension;
        $user=Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    $data['hospital_id']=$user->hospital->id;
                    $data['image']=$filename;
                    if(File::exists(public_path('/').'images/hospital'.$hospitalPromotion->hospital_id.'/promotions/promotion'.$hospitalPromotion->id.'/'.$hospitalPromotion->image)){
                        File::deleteDirectory(public_path('/').'images/hospital'.$hospitalPromotion->hospital_id.'/promotions/promotion'.$hospitalPromotion->id);
                    }
                    $hospitalPromotion->update($data);
                    $image->move(public_path('/').'images/hospital'.$hospitalPromotion->hospital_id.'/promotions/promotion'.$hospitalPromotion->id, $filename);
                    return response()->json(['success'=>true,'message'=>'Promotion updated successfully','data'=>$data],200);
                }else{
                    return response()->json(['success'=>false,'message'=>'You are unauthorized'],433);
                }
            }
        }catch (\Exception $e){
            return response()->json(['success'=>false,'message'=>$e->getMessage()],433);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalPromotions $hospitalPromotion)
    {
        $user=Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    if($user->hospital->id==$hospitalPromotion->hospital_id){
                        if(File::exists(public_path('/').'images/hospital'.$hospitalPromotion->hospital_id.'/promotions/promotion'.$hospitalPromotion->id.'/'.$hospitalPromotion->image)){
                            File::deleteDirectory(public_path('/').'images/hospital'.$hospitalPromotion->hospital_id.'/promotions/promotion'.$hospitalPromotion->id);
                        }
                        $hospitalPromotion->delete();
                        return response()->json(['success'=>true,'message'=>'Promotion deleted successfully'],200);
                    }else{
                        return response()->json(['success'=>false,'message'=>'You are unauthorized'],433);
                    }
                }
            }else {
                return response()->json(['success' => false, 'message' => 'You are unauthorized'], 433);
            }
        }catch (\Exception $e){
            return response()->json(['success' => false, 'message' => $e->getMessage()], 433);
        }
    }
}
