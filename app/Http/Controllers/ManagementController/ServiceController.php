<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\ServiceModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Service Index',
            'total' => 'Service',
            'route' => 'service.index'
        ];

        if($request->ajax()){

            $services = ServiceModel::get();

            return DataTables::of($services)
            ->editColumn('id', function ($service) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$service->id.'</span>';
            })
            ->editColumn('thumbnail', function ($service) {
                return '<img class="w-10 " src="'. $service->thumbnail . '" alt="'. $service->slug .'">';
            })
            ->editColumn('name', function ($service) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$service->name.'</span>';;
            })
            ->editColumn('slug', function ($service) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$service->slug.'</span>';;
            })
            ->editColumn('price', function ($service) {
                return $service->price();
            })
            ->addColumn('action', function ($service) {
                $routeDestroy = "'" . route('service.destroy',$service->id) . "'";
                $route_edit =  '<a href="'. route('service.edit', $service->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_detail =  '<a href="'. route('service.detail', $service->id) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail . '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','thumbnail','name','slug','price','action'])
            ->make();
        }
        return view('management.service.index',compact('name_page'));
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
    public function show(ServiceModel $serviceModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ServiceModel $serviceModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServiceModel $serviceModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServiceModel $serviceModel)
    {
        //
    }
}
