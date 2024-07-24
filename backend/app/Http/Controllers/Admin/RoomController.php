<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Room access|Room create|Room edit|Room delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Room create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Room edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Room delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        if ($user->hasRole('admin')) {
            $rooms = Room::all();
        }elseif($user->hasRole('hospital')){
            $rooms=$user->hospital->rooms->get();
        }else{
            return redirect()->back();
        }
        return view('room.index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::all();
        return view('room.new',compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user=Auth::user();
        $data=$request->validate([
            'name'=>'required',
            'hospital_id'=>'required|exists:hospitals,id',
        ]);
        try {
            if($user->hasRole('admin')){
                $room=Room::create($data);
            }elseif ($user->hasRole('hospital')){
                $data['hospital_id']=$user->hospital->id;
                $room=Room::create($data);
            }else{
                return redirect()->back()->with('error','Unauthorized Access');
            }
            return redirect()->route('room.index')->with('success','Room created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Room $room)
    {
        $user=Auth::user();
        try {
            if ($user->hasRole('admin')) {
                return response()->json(['success' => true, 'data' => $room], 200);
            } elseif ($user->hasRole('hospital')) {
                if ($room->hospital_id == $user->hospital->id) {
                    return response()->json(['success' => true, 'data' => $room], 200);
                }
            } else {
                return redirect()->back()->with('error','Unauthorized Access');
            }
            return  redirect()->back()->with('success','Room created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $data=request()->validate([
            'name'=>'required|string',
            'hospital_id'=>'required|exists:hospitals,id',
        ]);
        $user=Auth::user();
        try {
            if($user->hasRole('admin')){
                $room->update($data);
            }elseif ($user->hasRole('hospital')){
                $data['hospital_id']=$user->hospital->id;
                $room->update($data);
            }else{
                return response()->json(['error'=>'Unauthorized'], 401);
            }
            return response()->json(['success'=>'Room updated successfully.'],200);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'message'=>$exception->getMessage()],401);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        $user=Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $room->delete();
            }elseif ($user->hasRole('hospital')) {
                if($user->hospital->id==$room->hospital_id){
                    $room->delete();
                }else{
                    return response()->json(['success'=>false,'error'=>'Unauthorized'], 401);
                }
            }else{
                return response()->json(['success'=>false,'error'=>'Unauthorized'], 401);
            }
            return response()->json(['success'=>true,'message'=>'Room has been deleted.'],200);
        }catch (\Exception $exception){
            return response()->json(['success'=>false,'error'=>$exception->getMessage()],401);
        }
    }
}
