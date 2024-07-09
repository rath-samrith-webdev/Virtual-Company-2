<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Doctor access|Doctor create|Doctor edit|Doctor delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Doctor create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Doctor edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Doctor delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        if($user->hasRole('admin')){
            $doctors=Doctor::all();
        }elseif ($user->hasRole('hospital')) {
            $doctors=$user->hospital->doctors()->get();
        }
        return view('doctor.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals=Hospital::all();
        return view('doctor.new',compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Doctor $doctor)
    {
        $hospitals=Hospital::all();
        $data=['doctor'=>$doctor,'hospitals'=>$hospitals];
        return view('doctor.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Doctor $doctor)
    {
        $data=$request->validate([
            'first_name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'hospital_id'=>'required',
        ]);
        $user=Auth::user();
        $doc=$doctor->user;
        try {
            if($user->hasRole('admin')){
                $doc->update($data);
            }elseif ($user->hasRole('hospital')) {
                $data['hospital_id']=$data->hospital->id;
                $doc->update($data);
            }
            return redirect()->back()->with('success','Doctor updated successfully');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
