<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AppointmentResource;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Appointment access|Appointment create|Appointment edit|Appointment delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Appointment create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Appointment edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Appointment delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        if($user->hasRole('admin')){
            $appointments = Appointment::all();
        }elseif ($user->hasRole('hospital')) {
            $hospital=$user->hospital;
            $appointments=$hospital->appointments()->get();
        }elseif ($user->hasRole('doctor')) {
            $appointments=$user->doctor->appointments()->get();
        }
        else{
            $appointments=$user->appointments()->get();
        }
        return view('appointment.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uid=Auth::id();
        $users=User::all();
        $hospitals=Hospital::all();
        $doctors=Doctor::all();
        $data=['users'=>$users,'hospitals'=>$hospitals,'doctors'=>$doctors,'uid'=>$uid];
        return view('appointment.new',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $uid=Auth::id();
        $data=$request->validate([
            'title'=>'required|string',
            'hospital_id'=>'required|integer',
            'doctor_id'=>'required|integer',
            'appointment_date'=>'required|date',
            'user_id'=>'integer',
        ]);
        try {
            if($uid!==1){
                $data['user_id']=$uid;
            }
            Appointment::create($data);
            return redirect()->back()->withSuccess('Hospital updated !!!');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        $info=AppointmentResource::make($appointment);
        $users=User::all();
        $hospitals=Hospital::all();
        $doctors=Doctor::all();
        $data=['appointment'=>$info,'users'=>$users,'hospitals'=>$hospitals,'doctors'=>$doctors];    ;
        return view('appointment.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $uid=Auth::id();
        try {
            $appointment->delete();
            return redirect()->back()->withSuccess('Appointment deleted !!!');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
}
