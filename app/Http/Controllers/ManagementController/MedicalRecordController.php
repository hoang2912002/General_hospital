<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,UserModel $userModel)
    {
        if($request->ajax()){

            $medical_records = MedicalRecordModel::where('user_uuid',$userModel->uuid)->get();

            return DataTables::of($medical_records)
            ->editColumn('id', function ($medical_record) {
                //dd($medical_record->user_uuid());
                return $medical_record->id;
            })
            ->editColumn('disease', function ($medical_record) {

                return $medical_record->disease;
            })
            ->editColumn('doctor_uuid', function ($medical_record) {

                return $medical_record->doctor_uuid;
            })
            ->editColumn('appointment_id', function ($medical_record) {
                return $medical_record->appointment();
            })
            ->editColumn('re_exam_date', function ($medical_record) {
                return $medical_record->re_exam_date;
            })
            ->addColumn('action', function ($medical_record) {
                //dd($medical_record->user_uuid->uuid);
                $routeDestroy = "'" . route('medicalrecord.destroy',$medical_record->id) . "'";
                $route_edit =  '<a href="'. route('medicalrecord.edit', $medical_record->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $service_result =  '<a href="'. route('user.index') .'" class="badge bg-gradient-success" title="Kết quả xét nghiệm"><i class="fas fa-solid fa-microscope"></i></a>';
                $prescription =  '<a href="'. route('prescription.index',$medical_record->user_uuid) .'" class="badge bg-gradient-info" title="Xem toa thuốc"><i class="fas fa-solid fa-file-medical"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $service_result. '&nbsp' . $prescription . '&nbsp'    . $route_delete;
            })

            ->rawColumns(['id','disease','doctor_uuid','appointment_id','re_exam_date','action'])
            ->make();
        }
        $user = $userModel->uuid;
        $name_page = [
            'name' => 'Danh sách bệnh nhân',
            'total' => 'Khám bệnh',
            'route' => "medicalrecord.index",
            'params' => ['userModel' => $userModel->uuid],
        ];
        //dd($name_page);
        return view('management.medical_record.index',compact('name_page','userModel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(MedicalRecordModel $medicalRecordModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalRecordModel $medicalRecordModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecordModel $medicalRecordModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecordModel $medicalRecordModel)
    {
        //
    }
}
