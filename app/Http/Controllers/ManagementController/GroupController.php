<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\GroupModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'Group Index',
            'total' => 'Group',
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
        $name_page = [
            'name' => 'Group Create',
            'total' => 'Group',
            'route' => 'group.index'
        ];
        return view('management.group.create',compact('name_page'));
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
    public function show(GroupModel $groupModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroupModel $groupModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroupModel $groupModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroupModel $groupModel)
    {
        //
    }
}
