<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\HospitalPromotions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
                if($user->hasRole('hosptal')){
                    $data=$user->hospital->promotions()->get();
                    return response()->json(['success'=>true,'message'=>'Retrieved successful','data'=>$data],200);
                }
            }else{
                return response()->json(['success'=>false,'message'=>'You are unauthorized'],433);
            }
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
        $user=Auth::user();
        try {
            if(!$user->hasRole('admin')){
                if($user->hasRole('hospital')){
                    return response()->json(['success'=>true,'message'=>'Promotion created successfully','data'=>$data],200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HospitalPromotions $hospitalPromotion)
    {
        //
    }
}
