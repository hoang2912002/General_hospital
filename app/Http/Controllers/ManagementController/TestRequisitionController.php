<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\ServiceModel;
use App\Models\ManagementModel\TestRequisitionModel;
use App\Models\ManagementModel\UserModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TestRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_management(Request $request)
    {
        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Phiếu chỉ định',
            'route' => 'test_requisition.index_management'
        ];

        if($request->ajax()){

            $test_requisitions = TestRequisitionModel::get();

            return DataTables::of($test_requisitions)
            ->editColumn('id', function ($test_requisition) {
                return $test_requisition->id;
            })
            ->editColumn('full_name', function ($test_requisition) {

                return $test_requisition->medical_record->user->name();
            })
            ->editColumn('medical_record_id', function ($test_requisition) {

                return $test_requisition->medical_record_id;
            })
            ->editColumn('service_name', function ($test_requisition) {
                return $test_requisition->service->name;
            })
            ->addColumn('action', function ($test_requisition) {
                $routeDestroy = "'" . route('test_requisition.destroy',$test_requisition->id) . "'";
                $route_edit =  '<a href="'. route('test_requisition.edit', $test_requisition->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                //$route_detail =  '<a href="'. route('test_requisition.detail', $test_requisition->id) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit  . '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','full_name','medical_record_id','service_name','action'])
            ->make();
        }
        return view('management.test_requisition.index_management',compact('name_page'));
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
    public function show(TestRequisitionModel $test_requisitionModel)
    {
        //
    }
    public function redirect_print_test_requisition(Request $request,UserModel $userModel){
        //dd($request,$userModel);
        $pdfRoute = route('test_requisition.print_test_requisition', ['userModel' => $userModel,'medical_record_id' => $request->medical_record_id]);
        return response()->json(['success' => true, 'pdfRoute' => $pdfRoute]);
    }
    public function print_test_requisition(UserModel $userModel,Request $request){
        //dd($request->query('medical_record_id'));
        try {
            $medical_record_id = $request->query('medical_record_id') ? $request->query('medical_record_id') : null;
            if(!empty($medical_record_id)){
                $print_test_requisition = TestRequisitionModel::where('medical_record_id',$medical_record_id)->get();
                $patient_information = TestRequisitionModel::where('medical_record_id',$medical_record_id)->first();
                //dd(Pdf::loadview('management.test_requisition.print_test_requisition_file_pdf',compact('print_test_requisition'))->setPaper('A4'));
                $patient_name = $patient_information->medical_record->user->first_name . ' ' . $patient_information->medical_record->user->last_name;
                //dd($patient_information->medical_record->user_uuid);
                $pdf = Pdf::loadview('management.test_requisition.print_test_requisition_file_pdf',compact('print_test_requisition','patient_name','patient_information'))->setPaper('A4');
                //dd($pdf);
                return $pdf->download('benh-nhan-' . $patient_name . '-' . $patient_information->medical_record->user_uuid . '.pdf');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function render_test_requisition(UserModel $userModel,Request $request){
        try {
            $test_requisition = TestRequisitionModel::where('medical_record_id',$request->medical_record_id)->get();
            $array_id_service =  array_column($test_requisition->toArray(), 'service_id');
            //dd($array_id_service);
            if(!empty($request->searchTerm)){
                $service = ServiceModel::where('name', 'like', '%' . $request->searchTerm . '%')
                ->get();

            }
            else{
                $service = ServiceModel::get();
            }
            if(!empty($service->all())){
                foreach($service as $index => $item){
                    if (in_array($item->id, $array_id_service)) {
                        $service[$index]['checkbox'] = 1;
                    }
                }
            }
            return response()->json($service);
        } catch (\Throwable $th) {
            return response()->json('');
        }
    }
    public function store_test_requisition(UserModel $userModel, Request $request){
        try {
            $check_medical_record = TestRequisitionModel::where('medical_record_id', $request->medical_record_id);
            if(!empty($request->array_checkbox)){

                if(!empty($check_medical_record->get()->all())){
                    $delete_test_requisition = $check_medical_record->delete();
                }
                foreach($request->array_checkbox as $item){
                    $service_id = ServiceModel::where('slug',$item)->value('id');
                    $test_requisition = TestRequisitionModel::create([
                        'service_id' => $service_id,
                        'medical_record_id' => $request->medical_record_id,
                    ]);
                }
                if(!empty($test_requisition)){
                    return response()->json(['status' => "success"]);
                }

            }
            else{
                $delete_test_requisition = $check_medical_record->delete();
                return response()->json(['status' => "success"]);
            }

        } catch (\Throwable $th) {
            return response()->json(['status' => "error"]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TestRequisitionModel $test_requisitionModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TestRequisitionModel $test_requisitionModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TestRequisitionModel $test_requisitionModel)
    {
        //
    }
}
