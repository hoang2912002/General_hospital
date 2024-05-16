<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\MedicalRecordManagementRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\MedicalRecordManagementRequest\UpdateRequest;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\ServiceModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MedicalRecordManagementController extends Controller
{
    public function index(Request $request)
    {


        if($request->ajax()){
            $medical_records = MedicalRecordModel::get();

            return DataTables::of($medical_records)
            ->editColumn('id', function ($medical_record) {
                return $medical_record->id;
            })
            ->editColumn('full_name', function ($medical_record) {
                return $medical_record->user->name();
            })
            ->editColumn('reason', function ($medical_record) {
                return $medical_record->reason;
            })
            ->editColumn('weight', function ($medical_record) {
                return $medical_record->weight;
            })
            ->editColumn('height', function ($medical_record) {
                return $medical_record->height;
            })
            ->editColumn('vessel', function ($medical_record) {
                return $medical_record->vessel;
            })
            ->editColumn('blood_pressure', function ($medical_record) {
                return $medical_record->blood_pressure;
            })
            ->editColumn('temperature', function ($medical_record) {
                return $medical_record->temperature;
            })
            ->editColumn('disease', function ($medical_record) {
                return $medical_record->disease;
            })
            ->editColumn('doctor_uuid', function ($medical_record) {
                return $medical_record->doctor->name();
            })
            ->editColumn('appointment_id', function ($medical_record) {
                return $medical_record->appointment();
            })
            ->editColumn('exam_date', function ($medical_record) {
                return $medical_record->exam_date;
            })
            ->editColumn('re_exam_date', function ($medical_record) {
                return $medical_record->re_exam_date;
            })
            ->editColumn('shift_id', function ($medical_record) {
                return $medical_record->shift_id ;
            })
            ->addColumn('action', function ($medical_record){
                //dd($medical_record->user_uuid->uuid);
                $prescription_params = $medical_record->user_uuid . $medical_record->id;
                $routeDestroy = "'" . route('medical_record_management.destroy',$medical_record->id) . "'";
                $route_edit =  '<a href="'. route('medical_record_management.edit', $medical_record->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return  $route_edit. '&nbsp' . $route_delete;
            })

            ->rawColumns(['id','full_name','reason','weight','height','vessel','blood_pressure','temperature','exam_date','shift_id','disease','doctor_uuid','appointment_id','re_exam_date','action'])
            ->make();
        }

        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Hồ sơ bênh án',
            'route' => "medical_record_management.index",
        ];
        //dd($name_page);
        return view('management.medical_record.index_management',compact('name_page'));
    }

    public function create(){
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Hồ sơ bênh án',
            'route' => "medical_record_management.index",
        ];
        $doctors = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'bac-si');
            }); // hoặc where('name', 'Doctor')
        })->get();
        $patients = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'benh-nhan');
            }); // hoặc where('name', 'Doctor')
        })->get();
        $shifts = ShiftModel::get();
        //dd($doctors);
        return view('management.medical_record.create_management',compact('name_page','doctors','shifts','patients'));
    }
    public function store(StoreRequest $request){
        try {
            if(!empty($request->user_uuid) && !empty($request->doctor_uuid)){
                //dd($request);
                $medical_record = MedicalRecordModel::create([
                    'user_uuid' => $request->user_uuid,
                    'reason' => $request->reason,
                    'weight' => $request->weight,
                    'height' => $request->height,
                    'vessel' => $request->vessel,
                    'blood_pressure' => $request->blood_pressure,
                    'temperature' => $request->temperature,
                    'note' => $request->note,
                    'disease' => $request->disease,
                    'doctor_uuid' => $request->doctor_uuid,
                    're_exam_date' => $request->re_exam_date,
                    'exam_date' => $request->exam_date,
                    'shift_id' => $request->shift_id,
                    'appointment_id' => null,
                ]);
                if(!empty($medical_record)){
                    return redirect()->route('medical_record_management.index')->with('success' , 'Thêm hồ sơ bệnh án thành công!' );
                }

            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error' , 'Thêm hồ sơ bệnh án thất bại!' );
        }
    }
    public function edit(MedicalRecordModel $medical_recordModel){
        $name_page = [
            'name' => 'Cập nhật',
            'total' => 'Hồ sơ bênh án',
            'route' => "medical_record_management.index",
        ];
        $doctors = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'bac-si');
            }); // hoặc where('name', 'Doctor')
        })->get();
        $shifts = ShiftModel::get();
        $services = ServiceModel::get();
        //dd($doctors);
        return view('management.medical_record.update_management',compact('name_page','medical_recordModel','doctors','shifts','services'));
    }

    public function update(UpdateRequest $request, MedicalRecordModel $medical_recordModel){
        try {
            if(!empty($request->user_uuid) && !empty($request->doctor_uuid)){
                //dd($request);
                $medical_record = $medical_recordModel->update([
                    'user_uuid' => $request->user_uuid,
                    'reason' => $request->reason,
                    'weight' => $request->weight,
                    'height' => $request->height,
                    'vessel' => $request->vessel,
                    'blood_pressure' => $request->blood_pressure,
                    'temperature' => $request->temperature,
                    'note' => $request->note,
                    'disease' => $request->disease,
                    'doctor_uuid' => $request->doctor_uuid,
                    're_exam_date' => $request->re_exam_date,
                    'exam_date' => $request->exam_date,
                    'shift_id' => $request->shift_id,
                    'appointment_id' => null,
                ]);
                if(!empty($medical_record)){
                    return redirect()->route('medical_record_management.index')->with('success' , 'Cập nhật hồ sơ bệnh án thành công!' );
                }

            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error' , 'Cập nhật hồ sơ bệnh án thất bại!' );
        }
    }


    public function destroy(MedicalRecordModel $medicalRecordModel)
    {
        //
    }
}
