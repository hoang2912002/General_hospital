<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\DepartmentRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\DepartmentRequest\UpdateRequest;
use App\Models\ManagementModel\DepartmentModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',DepartmentModel::class);
        $name_page = [
            'name' => 'Bảng quản lý Khoa',
            'total' => 'Khoa',
            'route' => 'department.index'
        ];

        if($request->ajax()){

            $departments = DepartmentModel::get();
            return DataTables::of($departments)
            ->editColumn('id', function ($department) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$department->id.'</span>';
            })
            ->editColumn('name', function ($department) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$department->name.'</span>';;
            })
            ->editColumn('slug', function ($department) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$department->slug.'</span>';;
            })

            ->addColumn('action', function ($department) {
                $routeDestroy = "'" . route('department.destroy',$department->slug) . "'";
                $route_edit =  '<a href="'. route('department.edit', $department->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','slug','action'])
            ->make();
        }
        return view('management.department.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',DepartmentModel::class);
        $name_page = [
            'name' => 'Thêm khoa',
            'total' => 'Khoa',
            'route' => 'department.index'
        ];
        return view('management.department.create',compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //dd($request->all());
        try {
            $department = DepartmentModel::create($request->all());
            if(!empty($department)){
                return redirect()->route('department.index')->with('success','Thêm khoa thành công!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DepartmentModel $departmentModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepartmentModel $departmentModel)
    {
        $this->authorize('update',$departmentModel);
        $name_page = [
            'name' => 'Cập nhật khoa',
            'total' => 'Khoa',
            'route' => 'department.index'
        ];
        return view('management.department.update',compact('name_page','departmentModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, DepartmentModel $departmentModel)
    {
        //dd($request);
        try {
            $department = $departmentModel->update($request->all());
            if(!empty($department)){
                return redirect()->route('department.index')->with('success','Cập nhật khoa thành công!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentModel $departmentModel)
    {
        $this->authorize('delete',$departmentModel);
        try {
            if(empty($departmentModel->room[0])){
                $departmentModel->delete();
                return 1;
            }
            else{
               $departmentModel->room()->delete();
                return 1;
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
