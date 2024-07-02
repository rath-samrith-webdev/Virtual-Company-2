<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hospital;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('role_or_permission:Rate access|Rate create|Rate edit|Rate delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:Rate create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:Rate edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:Rate delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $rates = Rate::all();
            } elseif ($user->hasRole('hospital')) {
                $rates = $user->hospital->rates()->get();
            } else {
                $rates = $user->rates()->get();
            }
            return view('rate.index', compact('rates'));
        } catch (\Exception $exception) {
            return redirect()->route('rate.index')->with('error', $exception->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [];
        try {
            $data['users'] = User::all();
            $data['hospitals'] = Hospital::all();
            return view('rate.new',compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data=$request->validate([
            'hospital_id'=>'exists:hospitals,id',
            'content'=>'required|string',
            'user_id'=>'exists:users,id',
            'star'=>'required|integer'
        ]);
        try {
            if ($user->hasRole('admin')) {
                Rate::create($data);
                return redirect()->back()->with('success', 'Rate created successfully');
            }elseif ($user->hasRole('hospital')) {
                if($data['user_id']!==$user->id){
                    Rate::create($data);
                }else{
                    return redirect()->back()->with('error', 'You can not edit this rate');
                }
            }else{
                $data['user_id']=Auth::id();
                Rate::create($data);
                return redirect()->back()->with('success', 'Rate created successfully');
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
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
     * Show the form for editing the specified resource.
     */
    public function edit(Rate $rate)
    {
        $user = Auth::user();
        $data = [];
        try {
            $data['users'] = User::all();
            if ($user->hasRole('admin')) {
                $data['rate'] = $rate;
            } elseif ($user->hasRole('hospital')) {
                $data['rate'] = $rate;
            } else {
                if ($user->id == $rate->user_id) {
                    $data['rate'] = $rate;
                }
            }
            return view('rate.edit', compact('data'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rate $rate)
    {
        $user = Auth::user();
        $data = $request->validate([
            'content'=>'required|string',
            'user_id'=>'exists:users,id',
            'star'=>'required|integer'
        ]);
        try {
            if ($user->hasRole('admin')) {
                $rate->update($data);
                return redirect()->back()->with('success', 'Rate updated successfully');
            }elseif ($user->hasRole('hospital')) {
                $rate->update($data);
                return redirect()->back()->with('success', 'Rate updated successfully');
            }else{
                $data['user_id']=Auth::id();
                $rate->update($data);
                return redirect()->back()->with('success', 'Rate updated successfully');
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rate $rate)
    {
        //
    }
}
