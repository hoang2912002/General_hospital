<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\PatientRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\PatientRequest\UpdateRequest;
use App\Models\ManagementModel\AssignmentDayModel;
use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\AssignmentRoomModel;
use App\Models\ManagementModel\AssignmentShiftModel;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\GroupUserModel;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\Number_medicalRecordModel;
use App\Models\ManagementModel\NumberModel;
use App\Models\ManagementModel\ServiceModel;
use App\Models\ManagementModel\ServiceResultModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class ServiceResultController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = UserModel::get();
        $group = Auth::user()->User->group_user;
        $arr_role = ['bac-si','nhan-viet-xet-nghiem','nhan-vien-dich-vu'];
        if(in_array($group[0]->slug,$arr_role)){
            //dd(1);

            $assignment = AssignmentModel::where([
                ['staff_uuid',Auth::user()->User->uuid],
                ['date_end','>=', Carbon::now()],
            ])->first();
            $currentDayOfWeek = Carbon::now()->dayOfWeek;
            $currentDateTime = Carbon::now('Asia/Ho_Chi_Minh');
            $currentHour = $currentDateTime->toTimeString();
            //$currentMinute = Carbon::now()->minute;
            $currentHour = $currentDateTime->format('H:i:s');

            // So sánh giờ hiện tại với các giờ trong điều kiện so sánh
            if ($currentHour >= '06:00:00' && $currentHour <= '08:00:00') {
                $shift = 1;
            }
            elseif ($currentHour >= '08:00:00' && $currentHour <= '10:00:00') {
                $shift = 2;
            }
            elseif ($currentHour >= '10:00:00' && $currentHour <= '12:00:00') {
                $shift = 3;
            }
            elseif ($currentHour >= '12:00:00' && $currentHour <= '14:00:00') {
                $shift = 4;
            }
            elseif ($currentHour >= '14:00:00' && $currentHour <= '16:00:00') {
                $shift = 5;
            }
            elseif ($currentHour >= '16:00:00' && $currentHour <= '18:00:00') {
                $shift = 6;
            }
            elseif ($currentHour >= '18:00:00' && $currentHour <= '20:00:00') {
                $shift = 7;
            }
            elseif ($currentHour >= '20:00:00' && $currentHour <= '22:00:00') {
                $shift = 8;
            }
            elseif ($currentHour >= '22:00:00' && $currentHour <= '00:00:00') {
                $shift = 9;
            }
            elseif ($currentHour >= '00:00:00' && $currentHour <= '02:00:00') {
                $shift = 10;
            }
            elseif ($currentHour >= '02:00:00' && $currentHour <= '04:00:00') {
                $shift = 11;
            } else {
                $shift = 12; // Nếu không nằm trong bất kỳ khoảng thời gian nào
            }

            $assignment_day = AssignmentDayModel::where([
                ['assignment_id',$assignment->id],
                ['day_id',$currentDayOfWeek]
            ])->first();
            $assignment_shift = AssignmentShiftModel::where([
                ['assignment_id',$assignment->id],
                ['shift_id',$shift]
            ])->first();
            $assignment_room = AssignmentRoomModel::where([
                ['assignment_day_id',$assignment_day->id ?? ''],
                ['assignment_shift_id',$assignment_shift->id ?? ''],
            ])->first() ;
            //dd($assignment_room->room->number);
            $shift_name = $assignment_shift->shift_name ?? '';

        }
        $assignment_room = $assignment_room ?? '';
        $name_page = [
            'name' =>  $assignment_room->room->name ?? 'Trống',
            'total' => 'Phòng khám',
            'route' => 'patient.index'
        ];
        //dd($group[0]->slug);

        if($request->ajax()){
            //dd($assignment_room->room->number);
            $room_id = $assignment_room->room->id ?? [];
            $numbers = NumberModel::where('room_id', $room_id)->where('status', '=', 2)
            ->get();
            $services = ServiceModel::where('room_id', $room_id)->first();

            //dd($services->test_requisition[0]->medical_record->user->name());
            $test_requisitions = $services->test_requisition;
            return DataTables::of($test_requisitions)
            ->editColumn('disease', function ($test_requisition) {
                //dd($test_requisition);
                return '<p class="text-dark  mb-0 font-weight-400">'.$test_requisition->medical_record->disease .'</p>';
            })
            ->editColumn('patient_name', function ($test_requisition) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$test_requisition->medical_record->user->name().'</p>';
            })
            ->editColumn('service_name', function ($test_requisition) {
                return $test_requisition->service->name;
            })
            ->addColumn('action', function ($test_requisition) use ($assignment_shift,$assignment_day) {
                //<a href="{{ route('patient.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm bệnh nhân mới</a>&nbsp;
                $medical_record_id =$test_requisition->medical_record_id;
                $shift_id =  $assignment_shift->shift_id;
                $day_id =  $assignment_day->day_id;
                $route_create_service_result = '<a href="'. route('service_result.create', [
                    'medical_record_id' => $test_requisition->medical_record->id,
                    'shift_id' => $assignment_shift->shift_tbl->id,
                    'day_id' => $day_id,
                    'service_id' => $test_requisition->service->id
                ]) .'" class="badge bg-gradient-success" title="Danh sách bệnh nhân"><i class="fas fa-solid fa-hospital-user"></i></a>';

                $check = '';
                $route_edit =  '<a href="'. route('number.edit', $test_requisition->service->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '';
                return $route_edit . '&nbsp' . $route_create_service_result . '&nbsp' . $route_delete  ;
            })
            ->rawColumns(['disease','patient_name','service_name','action'])
            ->make();
        }
        return view('management.service_result.index',compact('name_page','assignment_room','shift_name'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create($medical_record_id,$shift_id,$day_id,$service_id)
    {
        if(!empty($medical_record_id) && !empty($shift_id) && !empty($service_id) && !empty($day_id)){
            $medical_recordModel = MedicalRecordModel::where('id', $medical_record_id)->first();
            $shiftModel = ShiftModel::where('id', $shift_id)->first();
            $serviceModel = ServiceModel::where('id', $service_id)->first();
            return view('management.service_result.create',compact('medical_recordModel','shiftModel','serviceModel','day_id'));
            //dd($medical_recordModel,$serviceModel);
        }
        else{
            return back()->with('error','Thiếu dữ liệu để thêm kết quả dịch vụ!');
        }
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
    public function show(ServiceResultModel $serviceResultModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceResultModel $serviceResultModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceResultModel $serviceResultModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceResultModel $serviceResultModel)
    {
        //
    }
}
