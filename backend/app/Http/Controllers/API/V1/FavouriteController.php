<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\UserFavorites;
use App\Models\Favourite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $favourites = Favourite::all();
            }elseif ($user->hasRole('hospital')) {
                return response()->json(['success' => true, 'message' => 'Favourite List']);
            }else{
                $favourites=$user->favorites()->get();
            }
            return response()->json(['success' => true,'message'=>'Requested Successful', 'data' => UserFavorites::collection($favourites)]);
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'user_id' => 'exists:users,id',
            'hospital_id' => 'exists:hospitals,id',
        ]);
        try {
            $favourite=Favourite::where('user_id',$data['user_id'])->first();
            if(!$favourite){
                if ($user->hasRole('admin')) {
                    $fav=Favourite::create($data);
                    return response()->json(['success' => true, 'message' => 'Favourite Added Successfully'],201);
                }elseif ($user->hasRole('hospital')) {
                    return response()->json(['success' => true, 'message' => 'Favourite Added Successfully'],201);
                }else{
                    $data['user_id']=$user->id;
                    $fav=Favourite::create($data);
                }
                return response()->json(['success' => true, 'message' => 'Favourite Added Successfully', 'data' => UserFavorites::make($fav)]);
            }else{
                return response()->json(['success' => false, 'message' => 'Favourite already added']);
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Favourite $favourite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Favourite $favourite)
    {
        $data=$request->validate([
            'user_id' => 'exists:users,id',
            'hospital_id' => 'exists:hospitals,id',
        ]);
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $favourite->update($data);
                return response()->json(['success' => true, 'message' => 'Favourite Updated Successfully'],201);
            }elseif ($user->hasRole('hospital')) {
                return response()->json(['success' => true, 'message' => 'Favourite Updated Successfully'],201);
            }else{
                $data['user_id']=$user->id;
                $favourite->update($data);
            }
            return response()->json(['success' => true, 'message' => 'Favourite Updated Successfully', 'data' => UserFavorites::make($favourite)]);
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Favourite $favourite)
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $favourite->delete();
            }elseif ($user->hasRole('hospital') && $favourite->user_id==$user->id) {
                $favourite->delete();
            }else{
                if($user->id==$favourite->user_id){
                    $favourite->delete();
                    return response()->json(['success' => true, 'message' => 'Favourite Deleted Successfully']);
                }else{
                    return response()->json(['success' => true, 'message' => 'Favourite already deleted']);
                }
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()]);
        }
    }
}
