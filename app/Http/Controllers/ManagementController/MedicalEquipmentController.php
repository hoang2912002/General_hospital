<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\MedicalEquipmentModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MedicalEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',MedicalEquipmentModel::class);
        $name_page = [
            'name' => 'Thư mục',
            'total' => 'Loại thiết bị y tế',
            'route' => 'medical_equipment.index'
        ];

        if($request->ajax()){

            $medical_equipments = MedicalEquipmentModel::get();
            return DataTables::of($medical_equipments)
            ->editColumn('checkbox', function ($medical_equipment) {
                return '<div class="form-check my-auto">
                <input class="form-check-input" name="' . $medical_equipment->id . '[]" value="'. $medical_equipment->id .'"  type="checkbox" id="customCheck1" checked=""></div>';
            })
            ->editColumn('id', function ($medical_equipment) {
                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->id.'</span>';
            })
            ->editColumn('image', function ($medical_equipment) {
                return '<img class="w-10 " src="'. $medical_equipment->image . '" alt="'. $medical_equipment->name .'">';
            })
            ->editColumn('name', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->name.'</span>';;
            })
            ->editColumn('status', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->status.'</span>';;
            })
            ->editColumn('production_date', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->production_date.'</span>';;
            })
            ->editColumn('exp_date', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->exp_date.'</span>';;
            })
            ->editColumn('quantity', function ($medical_equipment) {

                return '<span class="text-dark  mb-0 font-weight-400">'.$medical_equipment->quantity.'</span>';;
            })

            ->addColumn('action', function ($medical_equipment) {
                $routeDestroy = "'" . route('medical_equipment.destroy',$medical_equipment->id) . "'";
                $route_edit =  '<a href="'. route('medical_equipment.edit', $medical_equipment->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['checkbox','id','image','name','status','production_date','exp_date','quantity','action'])
            ->make();
        }
        return view('management.medical_equipment.index',compact('name_page'));
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
    public function show(MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }
}
