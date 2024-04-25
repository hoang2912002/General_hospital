<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\PatientRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\PatientRequest\UpdateRequest;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\GroupUserModel;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class PatientController extends Controller
{
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Danh sách bệnh nhân',
            'total' => 'Khám bệnh',
            'route' => 'patient.index'
        ];
        if($request->ajax()){

            $users = UserModel::get();

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
            ->addColumn('action', function ($user) {
                $routeDestroy = "'" . route('patient.destroy',$user->uuid) . "'";
                $route_edit =  '<a href="'. route('patient.edit', $user->uuid) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_medical_record =  '<a href="'. route('medical_record.index', $user->uuid) .'" class="badge bg-gradient-warning" title="Hồ sơ bệnh án"><i class="fas fa-solid fa-notes-medical"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_medical_record. '&nbsp'    . $route_delete;
            })

            ->rawColumns(['uuid','first_name','last_name','gender','dob','email','phone_number','action'])
            ->make();
        }
        return view('management.patient.index',compact('name_page'));
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
