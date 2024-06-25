<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    function __construct()
    {
        $this->middleware('role_or_permission:Department access|Department create|Department edit|Department delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Department create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Department edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Department delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        if($user->hasRole('admin')){
            $departments=Department::all();
        }elseif ($user->hasRole('hospital')) {
            $departments=$user->hospital->departments()->get();
        }
        return view('department.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals=Hospital::all();
        $data=['hospitals'=>$hospitals];
        return view('department.new', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            'hospital_id'=>'required',
        ]);
        $user=Auth::user();
        try {
            if($user->hasRole('admin')){
                $hospital=Department::create($data);
            }elseif ($user->hasRole('hospital')) {
                $data['hospital_id']=$user->hospital->id;
                Department::create($data);
            }
            return redirect()->back()->with('success', 'Department created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $hospitals=Hospital::all();
        $data=['department'=>$department,'hospitals'=>$hospitals];
        return view('department.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $user=Auth::user();
        $data=$request->validate([
            'name'=>'required',
            'hospital_id'=>'required',
        ]);
        try {
            if($user->hasRole('admin')){
                $department->update($data);
            }elseif ($user->hasRole('hospital')) {
                $data['hospital_id']=$user->hospital->id;
                $department->update($data);
            }
            return redirect()->back()->with('success', 'Department created successfully');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $user=Auth::user();
        try {
            if($user->hasRole('admin')){
                $department->delete();
            }elseif ($user->hasRole('hospital')) {
                $hospital_id=$user->hospital;
                if ($department->hospital_id==$hospital_id) {
                    $department->delete();
                }
            }
            return redirect()->back()->with('success', 'Department Deleted successfully');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors([$exception->getMessage()]);
        }
    }
}
