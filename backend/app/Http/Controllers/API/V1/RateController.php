<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\RateResource;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $feedback = Rate::all();
            } elseif ($user->hasRole('hospital')) {
                $feedback = $user->hospital->rates()->get();
            } else {
                $feedback = $user->rates()->get();
            }
            return response()->json(['success' => true, 'rates' => RateResource::collection($feedback)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'integer',
            'content' => 'required|string',
            'hospital_id' => 'required',
            'star' => 'integer'
        ]);
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                return response()->json(['success' => true, 'message' => 'Go to back end'], 200);
            } else {
                $data['user_id'] = $user->id;
            }
            Rate::create($data);
            return response()->json(['success' => true, 'message' => 'Rate has been created'], 201);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Rate $rate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rate $rate)
    {
        $data = $request->validate([
            'user_id' => 'integer',
            'content' => 'required|string',
            'hospital_id' => 'required',
            'star' => 'integer'
        ]);
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                return response()->json(['success' => true, 'message' => 'Go to back end'], 200);
            }
            if ($user->hasRole('hospital') && $rate->user_id == $user->id) {
                $rate->update($data);
                return response()->json(['success' => true, 'message' => 'Rate has been updated'], 201);
            }else{
                return response()->json(['success' => false, 'message' => 'You are not authorized'], 403);
            };
            if ($rate->user_id == $user->id) {
                $data['user_id'] = $user->id;
                $rate->update($data);
                return response()->json(['success' => true, 'message' => 'Rate has been updated'], 201);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                return response()->json(['success' => true, 'message' => 'Go to back end'], 200);
            }
            if ($user->hasRole('hospital') && $rate->user_id == $user->id) {
                $rate->delete();
                return response()->json(['success' => true, 'message' => 'Rate has been deleted'], 200);
            }else{
                return response()->json(['success' => false, 'message' => 'You are not authorized'], 403);
            };
            if ($rate->user_id == $user->id) {
                $data['user_id'] = $user->id;
                $rate->delete();
                return response()->json(['success' => true, 'message' => 'Rate has been deleted'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        };
    }
}
