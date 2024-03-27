<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\ManufacturerRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\ManufacturerRequest\UpdateRequest;
use App\Models\ManagementModel\ManufacturerModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ManufacturerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',ManufacturerModel::class);
        $name_page = [
            'name' => 'Manufacturer Index',
            'total' => 'Manufacturer',
            'route' => 'manufacturer.index'
        ];

        if($request->ajax()){

            $manufacturers = ManufacturerModel::get();

            return DataTables::of($manufacturers)
            ->editColumn('id', function ($manufacturer) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$manufacturer->id.'</span>';
            })
            ->editColumn('name', function ($manufacturer) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$manufacturer->name.'</span>';;
            })
            ->editColumn('address', function ($manufacturer) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$manufacturer->address.'</span>';;
            })
            ->editColumn('email', function ($manufacturer) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$manufacturer->email.'</span>';;
            })
            ->editColumn('phone_number', function ($manufacturer) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$manufacturer->phone_number.'</span>';;
            })

            ->addColumn('action', function ($manufacturer) {
                $routeDestroy = "'" . route('manufacturer.destroy',$manufacturer->id) . "'";
                $route_edit =  '<a href="'. route('manufacturer.edit', $manufacturer->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','address','email','phone_number','action'])
            ->make();
        }
        return view('management.manufacturer.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', ManufacturerModel::class);
        $name_page = [
            'name' => 'Manufacturer Create',
            'total' => 'Manufacturer',
            'route' => 'manufacturer.index'
        ];
        return view('management.manufacturer.create',compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $manufacturer = ManufacturerModel::create($request->all());
            if(!empty($manufacturer)){
                return redirect()->route('manufacturer.index')->with('success','Thêm nhà sản xuất ' . $request->name . 'thành công!');
            }
            else{
                return back()->with('error','Thêm nhà sản xuất thất bại!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ManufacturerModel $manufacturerModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManufacturerModel $manufacturerModel)
    {
        $this->authorize('update', $manufacturerModel);
        $name_page = [
            'name' => 'Cập nhập nhà sản xuất',
            'total' => 'Nhà sản xuất',
            'route' => 'manufacturer.index'
        ];
        return view('management.manufacturer.update',compact('name_page','manufacturerModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ManufacturerModel $manufacturerModel)
    {
        try {
            $manufacturer = $manufacturerModel->update($request->all());
            if(!empty($manufacturer)){
                return redirect()->route('manufacturer.index')->with('success','Cập nhật thông tin nhà sản xuất ' . $request->name . ' thành công!');
            }
            else{
                return back()->with('error','Cập nhật thông tin nhà sản xuất thất bại!');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManufacturerModel $manufacturerModel)
    {
        $this->authorize('delete', $manufacturerModel);
        try {
            if(empty($manufacturerModel->medicines[0])){
                $manufacturerModel->delete();
                return 1;
            }
            else{
                return 0;
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
