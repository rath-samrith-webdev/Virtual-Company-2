<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;

class HospitalController extends Controller
{

    function __construct()
    {
        $this->middleware('role_or_permission:Hospital access|Hospital create|Hospital edit|Hospital delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Hospital create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Hospital edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Hospital delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::latest()->get();
        return view('hospital.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users=User::all();
        $category=Category::all();
        $data=['users'=>$users,'category'=>$category];
        return view('hospital.new',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required',
            'user_id'=>'integer|required',
            'category_id'=>'integer|required',
            'street_address'=>'required',
            'village'=>'required',
            'commune'=>'required',
            'district'=>'required',
            'province'=>'required',
        ]);
        try {
            Hospital::create($data);
            return redirect()->back()->withSuccess('Hospital created !!!');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=>$exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Hospital $hospital)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hospital $hospital)
    {
        $users=User::all();
        $category=Category::all();
        $data=['hospital'=>$hospital,'users'=>$users,'category'=>$category];
        return view('hospital.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hospital $hospital)
    {
        $data=$request->validate([
            'name'=>'required',
            'street_address'=>'required',
            'village'=>'required',
            'commune'=>'required',
            'district'=>'required',
            'province'=>'required',
        ]);
        try {
            $hospital->update($data);
            return redirect()->back()->withSuccess('Hospital updated !!!');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors('Something went wrong !!!');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        try {
            $hospital->delete();
            return redirect()->back()->withSuccess('Hospital deleted !!!');
        }catch (\Exception $exception){
            return redirect()->back()->withErrors(['error'=>$exception->getMessage()]);
        }
    }
}
