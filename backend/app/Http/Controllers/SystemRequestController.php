<?php

namespace App\Http\Controllers;

use App\Models\SystemRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SystemRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['success' => true, 'data' => SystemRequest::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'category_id' => 'required|exists:system_request_categories,id',
            'request_details' => 'required|string',
            'user_id' => 'exists:users,id'
        ]);
        try {
            SystemRequest::create($data);
            return response()->json(['success' => true, 'data' => SystemRequest::all()]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'data' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SystemRequest $systemRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SystemRequest $systemRequest)
    {
        $user = Auth::user();
        $data = $request->validate([
            'category_id' => 'required|exists:system_request_categories,id',
            'request_details' => 'required|string',
            'user_id' => 'exists:users,id'
        ]);
        try {
            if ($user->hasRole('admin')) {
                SystemRequest::update($data);
            } elseif ($user->hasRole('hospital')) {
                SystemRequest::update($data);
            } else {
                $data['user_id'] = $user->id;
                SystemRequest::update($data);
            }
            return response()->json(['success' => true, 'data' => SystemRequest::all()]);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'data' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SystemRequest $systemRequest)
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $systemRequest->delete();
            } elseif ($user->hasRole('hospital')) {
                if ($user->id === $systemRequest->user_id) {
                    $systemRequest->delete();
                } else {
                    return response()->json(['success' => false, 'data' => 'You are not authorized to delete this']);
                }
            } else {
                if ($user->id === $systemRequest->user_id) {
                    $systemRequest->delete();
                } else {
                    return response()->json(['success' => false, 'data' => 'You are not authorized to delete this']);
                }
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'data' => $exception->getMessage()]);
        }
    }
}
