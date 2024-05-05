<?php

namespace App\Http\Controllers\ManagementController;

use App\Exports\ExcelExportGroups;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\GroupRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\GroupRequest\UpdateRequest;
use App\Imports\ExcelImportGroups;
use App\Models\ManagementModel\GroupModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',GroupModel::class);
        $name_page = [
            'name' => 'Danh mục',
            'total' => 'Nhóm',
            'route' => 'group.index'
        ];

        if($request->ajax()){

            $groups = GroupModel::get();

            return DataTables::of($groups)
            ->editColumn('id', function ($group) {

                return $group->id;
            })
            ->editColumn('name', function ($group) {

                return $group->name;
            })
            ->editColumn('slug', function ($group) {
                return $group->slug;
            })
            ->addColumn('action', function ($group) {
                $routeDestroy = "'" . route('group.create') . "'";
                $route_edit =  '<a href="'. route('group.edit', $group->slug) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_delete;
            })

            ->rawColumns(['id','name','slug','action'])
            ->make();
        }
        return view('management.group.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', GroupModel::class);
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Nhóm',
            'route' => 'group.index'
        ];
        return view('management.group.create',compact('name_page'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        //dd($request);
        try {
            $group = GroupModel::create($request->all());
            if(!empty($group)){
                return redirect()->route('group.index')->with('success','Thêm nhóm mới thành công!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Thêm nhóm thất bại!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(GroupModel $groupModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupModel $groupModel)
    {
        $this->authorize('update', $groupModel);
        $name_page = [
            'name' => 'Cập nhật',
            'total' => 'Nhóm',
            'route' => 'group.index'
        ];
        return view('management.group.update',compact('name_page','groupModel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, GroupModel $groupModel)
    {
        //dd($request);
        try {
            $group = $groupModel->update($request->all());
            if(!empty($group)){
                return redirect()->route('group.index')->with('success','Cập nhập nhóm ' . $request->name .  ' thành công!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Cập nhật nhóm thất bại!');
        }
    }

    public function import(Request $request)
    {
        if(!empty($request->file('file'))){
            $path = $request->file("file")->getRealPath();
            //dd($path);
            Excel::import(new ExcelImportGroups, $path);
            return back();
        }
        else{
            return back()->with('error','Vui lòng chọn file excel');
        }

    }
    public function export()
    {
        return Excel::download(new ExcelExportGroups , 'user-'  . date('s_i_H-Y_m_d') .  '.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupModel $groupModel)
    {
        $this->authorize('delete', GroupModel::class);
        // try {
        //     $group_user =GroupUserModel::where('group_id',$groupModel->id);
        //     if($group_user->get()->all() !== []){
        //         //dd($group_user);
        //         $group_user->delete();
        //     }
        //     $group = $groupModel->delete();
        //     if(!empty($group)){
        //         return 1;
        //     }
        //     else{
        //         return 0;
        //     }
        // } catch (\Throwable $th) {
        //     dd($th->getMessage());
        // }
    }
}
