<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\ServiceResultModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Web\Service;
use Yajra\DataTables\DataTables;

class ServiceResultManagementController extends Controller
{
    public function index(Request $request){
        $name_page = [
            'name' =>  'Danh mục',
            'total' => 'Kết quả dịch vụ',
            'route' => 'service_result_management.index'
        ];
        if($request->ajax()){

            $service_results = ServiceResultModel::get();

            return DataTables::of($service_results)
            ->editColumn('image', function ($service_result) {
                return '<img class="" style="height:30px" src="'. asset($service_result->result_file_path) . '" alt="'. $service_result->id .'">';
            })
            ->editColumn('id', function ($service_result) {
                return $service_result->id;
            })
            ->editColumn('medical_record_id', function ($service_result) {

                return $service_result->medical_record_id;
            })
            ->editColumn('name', function ($service_result) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$service_result->service->name.'</span>';
            })
            ->editColumn('price', function ($service_result) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$service_result->service->price_format().'</span>';
            })
            ->editColumn('shift_id', function ($service_result) {

                return $service_result->shift->hour();
            })
            ->editColumn('day_id', function ($service_result) {

                return $service_result->day_id;
            })
            ->addColumn('action', function ($service_result) {
                $routeDestroy = "'" . route('service_result_management.destroy',$service_result->id) . "'";
                $route_edit =  '<a href="'. route('service_result_management.edit', $service_result->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })
            ->rawColumns(['image','id','name','medical_record_id','price','shift_id','day_id','action'])
            ->make();
        }
        return view('management.service_result.index_management',compact('name_page'));
    }

    public function create(){
        $name_page = [
            'name' =>  'Thêm',
            'total' => 'Kết quả dịch vụ',
            'route' => 'service_result_management.index'
        ];
        $patients = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'benh-nhan');
            });
        })->get();
        $doctors  = UserModel::whereHas('gr_user', function ($query) {
            $query->whereHas('groups', function ($query){
                $query->where('slug', 'bac-si');
            });
        })->get();
        $shifts = ShiftModel::get();
        ///dd($patients);
        return view('management.service_result.create_management',compact('name_page','patients','doctors','shifts'));
    }

    public function edit(ServiceResultModel $service_resultModel){}
    public function update(Request  $request,ServiceResultModel $service_resultModel){}
    public function destroy(ServiceResultModel $service_resultModel){}
}
