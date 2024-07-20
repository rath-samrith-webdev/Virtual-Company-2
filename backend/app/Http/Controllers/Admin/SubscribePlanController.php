<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubscribePlan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('role_or_permission:User access|User create|User edit|User delete', ['only' => ['index','show']]);
        $this->middleware('role_or_permission:User create', ['only' => ['create','store']]);
        $this->middleware('role_or_permission:User edit', ['only' => ['edit','update']]);
        $this->middleware('role_or_permission:User delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $data = SubscribePlan::all();
        return view('setting.subscribe.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting.subscribe.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|string',
            'price'=>'required|string',
            'duration'=>'required|integer',
            'currency'=>'required|string',
        ]);
        $user=Auth::user();
        try {
            if($user->hasRole('admin')){
               SubscribePlan::create($data);
               return redirect()->route('admin.subscribePlans.index')->with('success','Subscribed successfully');
            }else{
                return redirect()->back()->with('error','You are not authorized to access this page');
            }
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SubscribePlan $subscribePlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscribePlan $subscribePlan)
    {
        return view('setting.subscribe.edit', compact('subscribePlan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubscribePlan $subscribePlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubscribePlan $subscribePlan)
    {
        try {
            $subscribePlan->delete();
            return redirect()->back()->withSuccess('Subscription Plan deleted !!!');
        }catch (\Exception $exception){
            return redirect()->back()->with('error',$exception->getMessage());
        }
    }
}
