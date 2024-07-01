<?php

namespace App\Http\Controllers;

use App\Http\Resources\V1\UserResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }

        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login success',
            'access_token' => $token,
            'role'=>$user->getRoleNames()[0],
            'token_type' => 'Bearer'
        ]);
    }
    public function logout()
    {
        $user = Auth::user();
        try {
            $user->currentAccessToken()->delete();
            return response()->json(['success' => true,'message'=>'You have been logged out'],200);
        }catch (\Exception $exception){
            return response()->json(['success' => false,'message'=>$exception->getMessage()],400);
        }
    }

    public function register(Request $request)
    {
        $data=$request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|confirmed',
            'user_type' => 'required|string'
        ]);
        $data['password'] = bcrypt($data['password']);
        try {
            if($data['user_type']=='hospital'){
                $user=User::create($data);
                $user->assignRole('hospital');
            }else{
                $user=User::create($data);
                $user->assignRole('user');
            }
            return response()->json(['success' => true,'message'=>'You have been registered'],201);
        }catch (\Exception $exception){
            return response()->json(['success' => false,'message'=>$exception->getMessage()],400);
        }
    }
    public function profileUpload(Request $request)
    {
        $data=$request->validate([
            'image' => 'image|mimes:jpeg,jpg,png'
        ]);
        $user=Auth::user();
        $name=$user->first_name;
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $filename= $name.'-'.time() . '.' . $extension;
        try {
            if(File::exists(public_path('/').'images/profiles/user'.$user->first_name.'/'.$user->profile)){
                File::delete(public_path('/').'images/profiles/user'.$user->first_name.'/'.$user->profile);
            }
            if($user->update(['profile' => $filename])){
                $image->move(public_path('/').'images/profiles/user-'.$user->first_name, $filename);
                return response()->json(['success' => true,'message'=>'Your profile has been uploaded','data'=>asset('/images/profiles/user-'.$user->first_name.'/'.$filename)],201);
            }else{
                return response()->json(['success' => false,'message'=>'Something went wrong'],400);
            }
        }catch (\Exception $exception){
            return response()->json(['success' => false,'message'=>$exception->getMessage()],400);
        }
    }
    public function index(Request $request)
    {
        $user = UserResource::make($request->user());
        $permissions = $user->getAllPermissions();
        $roles = $user->getRoleNames();
        return response()->json([
            'message' => 'Login success',
            'data' => $user,
            'permissions' => $permissions,
            'roles' => $roles
        ]);
    }
    public function profile()
    {
        $user=Auth::user();
        return response()->json(['success' => true,'data'=>UserResource::make($user)],200);
    }
    public function updateProfile(Request $request): JsonResponse
    {
        $data=$request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
        ]);
        $user=Auth::user();
        try {
            $user->update($data);
            return response()->json(['success' => true,'message'=>'You have been updated'],201);
        }catch (\Exception $exception){
            return response()->json(['success' => false,'message'=>$exception->getMessage()],400);
        }

    }
}
