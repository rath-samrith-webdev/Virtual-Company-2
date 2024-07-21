<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\HospitalResource;
use App\Http\Resources\V1\RateResource;
use App\Http\Resources\V1\TopRatedHospital;
use App\Models\Hospital;
use App\Models\Rate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            return response()->json(['success' => true, 'data' => RateResource::collection($feedback)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
    public function mostRated()
    {
        try {
            $rates=DB::table('rates')->select(DB::raw('AVG(star) as total, hospital_id'))->groupBy('hospital_id')->orderBy('total','DESC')->get();
            $data=array();
            foreach ($rates as $rate) {
                $data['hospital']=HospitalResource::make(Hospital::where('id',$rate->hospital_id)->first());
                $data['total_star']=round($rate->total);
            }
            return response()->json(['success' => true, 'data' => array($data)]);
        }catch (\Exception $e) {
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
        return response()->json(['success' => true, 'data' => new RateResource($rate)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rate $rate)
    {
        $data = $request->validate([
            'user_id' => 'integer',
            'content' => 'required|string',
            'hospital_id' => 'exists:hospitals,id',
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
            }elseif ($rate->user_id == $user->id) {
                $data['user_id'] = $user->id;
                $rate->update($data);
                return response()->json(['success' => true, 'message' => 'Rate has been updated'], 201);
            }else{
                return response()->json(['success' => false, 'message' => 'You are not authorized'], 403);
            };

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
    public function recentFeedback()
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $feedback = Rate::orderByDesc('id')->take(10)->get();
            } elseif ($user->hasRole('hospital')) {
                $feedback = $user->hospital->rates()->orderByDesc('id')->take(10)->get();
            } else {
                $feedback = $user->rates()->orderByDesc('id')->take(10)->get();
            }
            return response()->json(['success' => true, 'data' => RateResource::collection($feedback)]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
    public  function monthlyFeedback()
    {
        $user = Auth::user();
        $month=[1,2,3,4,5,6,7,8,9,10,11,12];
        $data=[];
        $year = Carbon::now()->year;
        try {
            if ($user->hasRole('admin')) {
                foreach ($month as $key=>$value) {
                    $data[]=Rate::whereYear('created_at', $year)
                        ->whereMonth('created_at', $value)->count();
                }
                return response()->json(['success' => true, 'message'=>'Request successful','data'=>$data], 200);
            }elseif ($user->hasRole('hospital')) {
                foreach ($month as $key=>$value) {
                    $data[]=$user->hospital->rates()->whereYear('created_at',$year)->whereMonth('created_at', $value)->count();
                }
                return response()->json(['success' => true, 'message'=>'Request successful','data'=>$data], 200);
            }else{
                return response()->json(['success' => false, 'message'=>'You are not authorized'], 403);
            }
        }catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 422);
        }
    }
}
