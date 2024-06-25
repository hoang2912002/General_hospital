<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\AppointmentRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\AppointmentRequest\UpdateRequest;
use App\Models\ManagementModel\AppointmentModel;
use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\NumberModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Lịch hẹn',
            'route' => 'appointment.index'
        ];

        if($request->ajax()){

            $appointments = AppointmentModel::get();
            return DataTables::of($appointments)
            ->editColumn('id', function ($appointment) {
                return $appointment->id;
            })
            ->editColumn('name', function ($appointment) {
                return $appointment->booker_full_name();
            })
            ->editColumn('patient_identification_code', function ($appointment) {
                return $appointment->patient_identification_code;
            })
            ->editColumn('doctor', function ($appointment) {
                return $appointment->doctor->name();
            })
            ->editColumn('status', function ($appointment) {
                return $appointment->status_name();
            })
            ->editColumn('date', function ($appointment) {
                return $appointment->date;
            })
            ->editColumn('shift_id', function ($appointment) {
                return $appointment->shift->name;
            })
            ->addColumn('action', function ($appointment) {
                $routeDestroy = "'" . route('appointment.destroy',$appointment->id) . "'";
                $route_edit =  '<a href="'. route('appointment.edit', $appointment->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_detail =  '<a href="#" class="badge bg-gradient-success" data-bs-toggle="modal" data-appointment-id="'.$appointment->id.'"
                data-bs-target="#modal-detail-appointment"  onclick="handleClick(\''.$appointment->id.'\')">
                <i class="fas fa-solid fa-file"></i>
                </a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail . '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','patient_identification_code','doctor','status','date','shift_id','action'])
            ->make();
        }
        return view('management.appointment.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Lịch hẹn',
            'route' => 'appointment.index'
        ];
        $shifts = ShiftModel::get();
        $doctors = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'bac-si');
            }); // hoặc where('name', 'Doctor')
        })->get();

        return view('management.appointment.create',compact('name_page','shifts','doctors'));
    }
    public function create_appointment(UserModel $userModel)
    {
        //dd($userModel->patients_identification->all());
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Lịch hẹn',
            'route' => 'appointment.index'
        ];
        $shifts = ShiftModel::get();
        $doctors = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'bac-si');
            }); // hoặc where('name', 'Doctor')
        })->get();

        return view('management.appointment.create_appointment',compact('name_page','shifts','doctors','userModel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            if(!empty($request)){
                $appointment = AppointmentModel::create($request->all());
                if(!empty($appointment)){
                    return redirect()->route('appointment.index')->with('success','Thêm lịch hẹn thành công!');
                }
                else{
                    return redirect()->back()->with('error','Thêm lịch hẹn thất bại!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Thêm lịch hẹn thất bại!');
        }
    }

    public function api_choose_doctor(Request $request)
    {
        $arr_shifts = [];
        try {
            if (!empty($request->doctor_uuid)) {
                $assignment = AssignmentModel::where('staff_uuid', $request->doctor_uuid)->first();
                if (!empty($assignment)) {
                    $shifts = $assignment->assignment_shift;
                    foreach ($shifts as $shift) {
                        $arr_shifts[$shift->shift_id] = $shift->shift_tbl->hour_flw_slug();
                    }
                }
            } else {
                $shifts = ShiftModel::all();
                foreach ($shifts as $shift) {
                    $arr_shifts[$shift->id] = $shift->hour_flw_slug();
                }
            }
            return response()->json(['arr_shifts' => $arr_shifts]);
        } catch (\Throwable $th) {
            return response()->json(['arr_shifts' => $arr_shifts]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(AppointmentModel $appointmentModel)
    {
        //
    }
    public function detail(Request $request){
        try {
            if(!empty($request->appointment)){
                //dd(!empty($request->appointment));
                $appointment = AppointmentModel::where('id',$request->appointment)->first();
                $expires_at = Carbon::parse($appointment->date)->addHours(24);
                $number = NumberModel::where([
                    ['first_name', '=', $appointment->first_name],
                    ['last_name', '=', $appointment->last_name],
                    ['gender', '=', $appointment->gender],
                    ['dob', '=', $appointment->dob],
                    ['email', '=', $appointment->email],
                    ['phone_number', '=', $appointment->phone_number],
                    ['patient_identification_code', '=', $appointment->patient_identification_code],
                    ['expires_at', '=' , $expires_at],
                    ['status', '=', 1],
                    ['shift_id', '=', $appointment->shift_id],
                ])->first();
                
                $arr = [];
                if(!empty($appointment)){
                    $arr = [
                        'id' => $appointment->id,
                        'user_uuid' => $appointment->user_uuid,
                        'name' => $appointment->last_name . ' ' . $appointment->first_name,
                        'gender' => $appointment->gender(),
                        'dob' => $appointment->date($appointment->dob),
                        'email' => $appointment->email,
                        'phone_number' => $appointment->phone_number,
                        'patient_identification_code' => $appointment->patient_identification_code,
                        'doctor_uuid' => $appointment->doctor->name(),
                        'status' => $appointment->status_name(),
                        'note' => $appointment->note,
                        'date' => $appointment->date($appointment->date),
                        'shift_id' => $appointment->shift->hour_flw_slug(),
                        'number_id' => $number->id ?? null,
                        'department_name' => $number->room->department->name ?? null,
                        'medical_examination_day' => $appointment->medical_examination_day() ?? null,
                        'room_name' => $number->room->name ?? null,
                        'number' => $number->number ?? null,
                    ];
                }
                return response()->json(['arr'=> $arr]);
            }
        } catch (\Throwable $th) {
            return response()->json(['arr'=> []]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AppointmentModel $appointmentModel)
    {
        $name_page = [
            'name' => 'Cập nhật',
            'total' => 'Lịch hẹn',
            'route' => 'appointment.index'
        ];
        $shifts = ShiftModel::get();
        $doctors = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'bac-si');
            }); // hoặc where('name', 'Doctor')
        })->get();

        return view('management.appointment.update',compact('name_page','shifts','doctors','appointmentModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, AppointmentModel $appointmentModel)
    {
        try {
            if (!empty($appointmentModel) && !empty($request)) {
                $appointment = $appointmentModel->update($request->all());
                if(!empty($appointment)){
                    return redirect()->route('appointment.index')->with('success','Cập nhật lịch hẹn thành công!');
                }
                else{
                    return redirect()->back()->with('error','Cập nhật lịch hẹn thất bại!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Cập nhật lịch hẹn thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AppointmentModel $appointmentModel)
    {
        //
    }
}
