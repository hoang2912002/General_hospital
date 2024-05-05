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
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class PatientController extends Controller
{
    public function index(Request $request)
    {

        $users = UserModel::get();
        $group = Auth::user()->User->group_user;

        if($group[0]->slug === 'bac-si'){
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
            $numbers = NumberModel::where('room_id', $room_id)->where('status', '<>', 3)
            ->get();
            //dd($numbers);

            return DataTables::of($numbers)
            ->editColumn('number_id', function ($number) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$number->number.'</p>';
            })
            ->editColumn('status', function ($number) {
                return $number->status();
            })
            ->addColumn('action', function ($number) {
                //<a href="{{ route('patient.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm bệnh nhân mới</a>&nbsp;
                $route_create_new_patient =  '<a href="'. route('patient.patient_list',$number->id) .'" class="badge bg-gradient-success" title="Danh sách bệnh nhân"><i class="fas fa-solid fa-hospital-user"></i></a>';
                $route_edit =  '<a href="'. route('number.edit', $number->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                return $route_edit . '&nbsp' . $route_create_new_patient ;
            })
            ->rawColumns(['number_id','status','action'])
            ->make();
        }
        return view('management.patient.index',compact('name_page','assignment_room','shift_name'));
    }

    public function patient_list(Request $request,NumberModel $numberModel){
        $name_page = [
            'name' => 'Danh sách bệnh nhân',
            'total' => 'Phòng khám',
            'route' => 'patient.index'
        ];
        if(!empty($numberModel)){
            $number = $numberModel->update([
                'status' => 2
            ]);
        }
        if(!empty($numberModel->number_medical_record)){
            return redirect()->route('medical_record.index',['numberModel' => $numberModel->id, 'userModel' => $numberModel->number_medical_record->patient_uuid]);
        }
        if($request->ajax()){
            $users = UserModel::whereHas('gr_user', function ($query) {
                $query->whereHas('groups', function ($query) {
                    $query->where('slug', 'benh-nhan');
                });
            })->with('gr_user.groups')->get();
            //dd($users);
            return DataTables::of($users)
            ->editColumn('uuid', function ($user) {
                return $user->uuid;
            })
            ->editColumn('first_name', function ($user) {

                return $user->first_name;
            })
            ->editColumn('last_name', function ($user) {

                return $user->last_name;
            })
            ->editColumn('gender', function ($user) {
                return $user->gender();
            })
            ->editColumn('dob', function ($user) {
                return $user->dob   ();
            })
            ->editColumn('email', function ($user) {
                return $user->login->email;
            })
            ->editColumn('phone_number', function ($user) {
                return $user->login->phone_number;
            })
            ->addColumn('action', function ($user) use ($numberModel) {
                $routeDestroy = "'" . route('patient.destroy',$user->uuid) . "'";
                $route_edit =  '<a href="'. route('patient.edit', $user->uuid) .'" class="badge bg-gradient-warning"><i class="fas fa-edit"></i></a>';
                $route_check = route('patient.patient_medical_record', ['numberModel' => $numberModel->id, 'userModel' => $user->uuid]);
                $route_patient_medical_record = '<a href="'. $route_check .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-check"></i></a>';
                //$route_medical_record =  '<a href="'. route('medical_record.index', ['numberModel' => $numberModel->id, 'userModel' => $user]) .'" class="badge bg-gradient-warning" title="Hồ sơ bệnh án"><i class="fas fa-solid fa-notes-medical"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return  $route_patient_medical_record . '&nbsp' . $route_edit . '&nbsp'    . $route_delete;
            })

            ->rawColumns(['uuid','first_name','last_name','gender','dob','email','phone_number','action'])
            ->make();
        }
        return view('management.patient.patient_list',compact('name_page','numberModel'));
    }
    public function create(){
        $name_page = [
            'name' => 'Thêm bệnh nhân',
            'total' => 'Khám bệnh',
            'route' => 'patient.index'
        ];
        $role = GroupModel::where('slug','benh-nhan')->first();

        $shift = ShiftModel::get();
        //dd($slug);
        return view('management.patient.create',compact('name_page','role','shift'));
    }

    public function store(StoreRequest $request){
        try {
            $login = $request->only('email','phone_number','password','activated');
            //dd($request,Auth::user()->user->uuid);

            if(isset($login)){
                $patient_acc = LoginModel::create($login);
                if(!empty($patient_acc)){
                    $patient_information = UserModel::create([
                        'uuid' => (string)Str::uuid(),
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'gender' => $request->gender,
                        'dob' => $request->birthdate,
                        'login_id' => $patient_acc->id,
                    ]);
                    if(!empty($patient_information)){
                        $patient_group = GroupUserModel::create([
                            'user_uuid' => $patient_information->uuid,
                            'group_id' => $request->group,
                        ]);
                        if(!empty($patient_group)){
                            $medical_record = MedicalRecordModel::create([
                                'user_uuid' => $patient_information->uuid,
                                'reason' => $request->reason,
                                'weight' => $request->weight,
                                'height' => $request->height,
                                'vessel' => $request->vessel,
                                'blood_pressure' => $request->blood_pressure,
                                'temperature' => $request->temperature,
                                'disease' => $request->disease,
                                'doctor_uuid' => Auth::user()->user->uuid,
                                're_exam_date' => $request->re_exam_date,
                                'note' => $request->note,
                                'day_id' => 1,
                                'shift_id' => $request->shift_id,
                                'appointment_id' => Null,
                            ]);
                            if(!empty($medical_record)){
                                return redirect()->route('patient.index')->with('success' , 'Thêm bệnh nhân ' . $request->first_name . $request->last_name  . ' thành công!' );
                            }
                            else{
                                return redirect()->back()->with('error','Vui lòng kiểm tra lại thông tin ở hồ sơ bệnh án');
                            }
                        }
                        else{
                            return redirect()->back()->with('error','Vui lòng kiểm tra lại thông tin bệnh nhân');
                        }
                    }
                    else{
                        return redirect()->back()->with('error','Vui lòng kiểm tra lại thông tin bệnh nhân');
                    }
                }
                else{
                    return redirect()->back()->with('error','Vui lòng kiểm tra lại email và số điện thoại');
                }
            }
        } catch (\Throwable $th) {
            //return redirect()->back()->with('error','Thêm thông tin bệnh nhân thất bại!');
            dd($th->getMessage());
        }
    }

    public function edit(UserModel $userModel){

        $name_page = [
            'name' => 'Sửa thông tin bệnh nhân',
            'total' => 'Khám bệnh',
            'route' => 'patient.index'
        ];
        $role = GroupModel::where('slug','benh-nhan')->first();

        $shift = ShiftModel::get();
        //dd($slug);
        return view('management.patient.update',compact('name_page','role','shift','userModel'));
    }

    public function update(UpdateRequest $request, UserModel $userModel){
        //dd($request);
        try {
            $login = $request->only('email','phone_number','activated');
            //dd($request,Auth::user()->user->uuid);

            if(isset($login)){
                $patient_acc = $userModel->login()->update($login);
                if(!empty($patient_acc)){
                    $patient_information = $userModel->update([
                        'first_name' => $request->first_name,
                        'last_name' => $request->last_name,
                        'gender' => $request->gender,
                        'dob' => $request->birthdate,
                        'login_id' => $userModel->login_id,
                    ]);

                    if(!empty($patient_information)){
                        $patient_group = $userModel->group_user()->update([
                            'user_uuid' => $userModel->uuid,
                            'group_id' => $request->group,
                        ]);

                        if(!empty($patient_group)){
                            $medical_record = $userModel->medical_record()->update([
                                'user_uuid' =>  $userModel->uuid,
                                'reason' => $request->reason,
                                'weight' => $request->weight,
                                'height' => $request->height,
                                'vessel' => $request->vessel,
                                'blood_pressure' => $request->blood_pressure,
                                'temperature' => $request->temperature,
                                'disease' => $request->disease,
                                'doctor_uuid' => Auth::user()->user->uuid,
                                're_exam_date' => $request->re_exam_date,
                                'note' => $request->note,
                                'day_id' => 1,
                                'shift_id' => $request->shift_id,
                                'appointment_id' => Null,
                            ]);
                            if(!empty($medical_record)){
                                return redirect()->route('patient.index')->with('success' , 'Sửa thông tin bệnh nhân ' . $request->first_name . $request->last_name  . ' thành công!' );
                            }
                            else{
                                return redirect()->back()->with('error','Vui lòng kiểm tra lại thông tin ở hồ sơ bệnh án');
                            }
                        }
                        else{
                            return redirect()->back()->with('error','Vui lòng kiểm tra lại thông tin bệnh nhân');
                        }
                    }
                    else{
                        return redirect()->back()->with('error','Vui lòng kiểm tra lại thông tin bệnh nhân');
                    }
                }
                else{
                    return redirect()->back()->with('error','Vui lòng kiểm tra lại email và số điện thoại');
                }
            }
        } catch (\Throwable $th) {
            //return redirect()->back()->with('error','Thêm thông tin bệnh nhân thất bại!');
            return redirect()->back()->with('error','Cập nhật bệnh nhân thất bại!');
        }
    }

    public function patient_medical_record(NumberModel $numberModel,UserModel $userModel){
        if(!empty($numberModel) && !empty($userModel)){
            $check = Number_medicalRecordModel::where([
                ['number_id',$numberModel->id],
                ['patient_uuid', $userModel->uuid],

            ])->first();
            if(empty($check)){
                $number_medical_records = Number_medicalRecordModel::create([
                    'number_id' => $numberModel->id,
                    'patient_uuid' => $userModel->uuid,
                ]);
            }
            return redirect()->route('medical_record.index',['numberModel' => $numberModel->id, 'userModel' => $userModel->uuid]);
        }
    }

    // public function destroy(UserModel $userModel)
    // {
    //     //$this->authorize('delete', $manufacturerModel);
    //     try {
    //         if(empty($userModel->medical_record())){
    //             $userModel->delete();
    //             return 1;
    //         }
    //         else{
    //             return 0;
    //         }
    //     } catch (\Throwable $th) {
    //         dd($th->getMessage());
    //     }
    // }
}
