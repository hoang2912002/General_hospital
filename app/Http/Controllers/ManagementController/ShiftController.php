<?php

namespace App\Http\Controllers\ManagementController;

use App\Exports\ExcelExportShifts;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\ShiftRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\ShiftRequest\UpdateRequest;
use App\Imports\ExcelImportShifts;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\ShiftModel;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;

class ShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',ShiftModel::class);

        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Ca',
            'route' => 'shift.index'
        ];

        if($request->ajax()){

            $shifts = ShiftModel::get();

            return DataTables::of($shifts)
            ->editColumn('id', function ($shift) {
                return '<p class="text-dark  mb-0 font-weight-400">'.$shift->id.'</span>';
            })
            ->editColumn('name', function ($shift) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$shift->name.'</span>';;
            })
            ->editColumn('slug', function ($shift) {

                return '<p class="text-dark  mb-0 font-weight-400">'.$shift->slug.'</span>';;
            })

            ->addColumn('action', function ($shift) {
                $routeDestroy = "'" . route('shift.destroy',$shift->slug) . "'";
                $route_edit =  '<a href="'. route('shift.edit', $shift->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit .  '&nbsp'  . $route_delete;
            })

            ->rawColumns(['id','name','slug','action'])
            ->make();
        }
        return view('management.shift.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create',ShiftModel::class);
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Ca',
            'route' => 'shift.index'
        ];
        return view('management.shift.create',compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            $shift = ShiftModel::create($request->all());
            if(!empty($shift)){
                return redirect()->route('shift.index')->with('success','Thêm ca ' . $request->name . 'thành công!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Thêm ca trực thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ShiftModel $shiftModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ShiftModel $shiftModel)
    {
        $this->authorize('update',$shiftModel);

        $name_page = [
            'name' => 'Cập nhật',
            'total' => 'Ca',
            'route' => 'shift.index'
        ];
        return view('management.shift.update',compact('shiftModel','name_page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, ShiftModel $shiftModel)
    {
        try {
            $shift = $shiftModel->update($request->all());
            if(!empty($shift)){
                return redirect()->route('shift.index')->with('success','Cập nhật  ' . $request->name . ' thành công!');
            }
            else{
                return back()->with('error','Cập nhật thông tin ca thất bại!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Cập nhật ca trực thất bại!');
        }
    }

    public function import(Request $request)
    {
        if(!empty($request->file('file'))){
            $path = $request->file("file")->getRealPath();
            //dd($path);
            Excel::import(new ExcelImportShifts, $path);
            return back();
        }
        else{
            return back()->with('error','Vui lòng chọn file excel');
        }


    }
    public function export()
    {
        return Excel::download(new ExcelExportShifts , 'ca-truc-'  . date('s_i_H-Y_m_d') .  '.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ShiftModel $shiftModel)
    {
        $this->authorize('delete',$shiftModel);
        try {
            if($shiftModel->delete()){
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
