<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\UserServiceModel;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //code ở index service result controller
        // return DataTables::of($test_requisitions)
            // ->editColumn('disease', function ($test_requisition) {
            //     //dd($test_requisition);
            //     return '<p class="text-dark  mb-0 font-weight-400">'.$test_requisition->medical_record->disease .'</p>';
            // })
            // ->editColumn('patient_name', function ($test_requisition) {
            //     return '<p class="text-dark  mb-0 font-weight-400">'.$test_requisition->medical_record->user->name().'</p>';
            // })
            // ->editColumn('service_name', function ($test_requisition) {
            //     return $test_requisition->service->name;
            // })
            // ->addColumn('action', function ($test_requisition) use ($assignment_shift,$assignment_day) {
            //     //<a href="{{ route('patient.create') }}" class="btn bg-gradient-primary btn-sm mb-0 "   target="">+&nbsp; Thêm bệnh nhân mới</a>&nbsp;
                // $medical_record_id =$test_requisition->medical_record_id;
                // $shift_id =  $assignment_shift->shift_id;
                // $day_id =  $assignment_day->day_id;
                // $route_create_service_result = '<a href="'. route('service_result.create', [
                //     'medical_record_id' => $test_requisition->medical_record->id,
                //     'shift_id' => $assignment_shift->shift_tbl->id,
                //     'day_id' => $day_id,
                //     'service_id' => $test_requisition->service->id
                // ]) .'" class="badge bg-gradient-success" title="Danh sách bệnh nhân"><i class="fas fa-solid fa-hospital-user"></i></a>';

                // $check = '';
                // $route_edit =  '<a href="'. route('number.edit', $test_requisition->service->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                // $route_delete = '';
                // return $route_edit . '&nbsp' . $route_create_service_result . '&nbsp' . $route_delete  ;
            // })
            // ->rawColumns(['disease','patient_name','service_name','action'])
            // ->make();
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
    public function show(UserServiceModel $userServiceModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserServiceModel $userServiceModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserServiceModel $userServiceModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserServiceModel $userServiceModel)
    {
        //
    }
}
