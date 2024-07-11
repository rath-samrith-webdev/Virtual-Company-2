<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\AppointmentResource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $appointments = Appointment::all();
                return response()->json(['success' => true, "data" => AppointmentResource::collection($appointments)], 200);
            } elseif ($user->hasRole('hospital')) {
                $appointments = $user->hospital->appointments()->get();
                return response()->json(['success' => true, "data" => AppointmentResource::collection($appointments)], 200);
            } elseif ($user->hasRole('doctor')) {
                $appointments = $user->doctor->appointments()->get();
                return response()->json(['success' => true, 'data' => AppointmentResource::collection($appointments)], 200);
            } else {
                $appointments = $user->appointments()->get();
                return response()->json(['success' => true, 'data' => AppointmentResource::collection($appointments)], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => ['message' => $e->getMessage()]], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string',
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);
        $data['user_id'] = Auth::id();
        try {
            Appointment::create($data);
            return response()->json(['success' => true, "data" => AppointmentResource::collection(Appointment::all())], 201);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        try {
            return response()->json(['success' => true, "data" => AppointmentResource::make($appointment)], 200);
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'hospital_id' => 'required|exists:hospitals,id',
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
        ]);
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                return response() - json(['success' => false, 'message' => 'You are not authorized to update appointment.'], 403);
            } elseif ($user->hasRole('hospital')) {
                if ($appointment->hospital_id == $data['hospital_id']) {
                    $appointment->update($data);
                    return response()->json(['success' => true, 'message' => 'Appointment updated successfully', "data" => Appointment::all()], 200);
                } else {
                    return response()->json(['success' => false, 'message' => 'You are not authorized to update appointment.'], 403);
                }
            } else {
                $data['user_id'] = Auth::id();
                $appointment->update($data);
                return response()->json(['success' => true, 'message' => 'Appointment updated successfully'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        try {
            if ($appointment->user_id == Auth::id()) {
                $appointment->delete();
                return response()->json(['success' => true, 'message' => 'Appointment has been deleted'], 200);
            } else {
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 500);
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

    public function updateAppointments(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'status' => 'required|string',
        ]);
        $user = Auth::user();
        try {
            if ($appointment->status !== 'Canceled' && $appointment->status !== 'Confirmed') {
                if ($user->hasRole('admin')) {
                    $appointment->update($data);
                } elseif ($user->hasRole('hospital')) {
                    $appointment->update(['hospital_status'=>$data['status']]);
                } elseif ($user->hasRole('doctor')) {
                    $appointment->update(['doctor_status'=>$data['status']]);
                }elseif ($user->id == $appointment->user_id) {
                    $appointment->update($data);
                }else {
                    return response()->json(['success' => false, 'message' => 'Unauthorized'], 500);
                }
                return response()->json(['success' => true, 'message' => 'Appointments has been Update successfully','data'=>$appointment], 200);
            } else {
                if($appointment->hospital_status=='Confirmed' && $appointment->doctor_status='Confirmed'){
                    $appointment->update(['status'=>'Confirmed']);
                }
                return response()->json(['success' => false, 'message' => 'This Appointment has already been canceled'], 200);
            }
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
    public function todayAppointment()
    {
        $user = Auth::user();
        $date=Carbon::today()->toDateString();
        try {
            if ($user->hasRole('admin')) {
                $todayAppointment=Appointment::where('appointment_date', $date)->get();
            }elseif ($user->hasRole('hospital')) {
                $hospital=$user->hospital;
                if($hospital){
                    $todayAppointment=$hospital->appointments()->where('appointment_date', $date)->get();
                }
            }else{
                $todayAppointment=$user->appointments()->where('appointment',$date)->get();
            }
            return response()->json(['success' => true,'date'=>$date, 'data' => AppointmentResource::collection($todayAppointment)], 200);
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
    public function monthlyAppointments()
    {
        $month=[1,2,3,4,5,6,7,8,9,10,11,12];
        $user = Auth::user();
        $data=[];
        $year = Carbon::now()->year;
        try {
            if ($user->hasRole('admin')) {
                foreach ($month as $key=>$value) {
                    $data[]=Appointment::whereYear('created_at', $year)
                        ->whereMonth('created_at', $value)->count();
                }
            }elseif ($user->hasRole('hospital')) {
                $hospital=$user->hospital;
                foreach ($month as $key=>$value) {
                    $data[]=$hospital->appointments()->whereYear('created_at', $year)
                        ->whereMonth('created_at', $value)->count();
                }
            }elseif ($user->hasRole('doctor')) {
                $doctor=$user->doctor;
                foreach ($month as $key=>$value) {
                    $data[]=$doctor->appointments()->whereYear('created_at', $year)
                        ->whereMonth('created_at', $value)->count();
                }
            }else{
                foreach ($month as $key=>$value) {
                    $data[]=$user->appointments()->whereYear('created_at', $year)->whereMonth('created_at', $value)->count();
                }
            }
            return response()->json(['success' => true, 'data' => $data], 200);
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }
    public function appointmentSummary(){
        $user = Auth::user();
        try {
            if ($user->hasRole('admin')) {
                $today=Appointment::where('appointment_date',Carbon::now()->format('Y-m-d'))->count();
                $confirmed=Appointment::where('status','Confirmed')->count();
                $pending=Appointment::where('status','Pending')->count();
                $missing=Appointment::where('status','Missing')->count();
            }elseif ($user->hasRole('hospital')) {
                $today=$user->hospital->appointments()->where('appointment_date',Carbon::now()->format('Y-m-d'))->count();
                $confirmed=$user->hospital->appointments()->where('status','Confirmed')->count();
                $pending=$user->hospital->appointments()->where('status','Pending')->count();
                $missing=$user->hospital->appointments()->where('status','Missing')->count();
            }elseif($user->hasRole('doctor')){
                $today=$user->doctor->appointments()->where('appointment_date',Carbon::now()->format('Y-m-d'))->count();
                $confirmed=$user->doctor->appointments()->where('status','Confirmed')->count();
                $pending=$user->doctor->appointments()->where('status','Confirmed')->count();
                $missing=$user->doctor->appointments()->where('status','Missing')->count();
            }else{
                return response()->json(['success' => false, 'message' => 'Unauthorized'], 500);
            }
            return response()->json(['success' => true, 'data' => [
                'today' => $today,
                'confirmed' => $confirmed,
                'missing' => $missing,
                'pending'=>$pending
            ]],200);
        }catch (\Exception $exception){
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
        }
    }

}
