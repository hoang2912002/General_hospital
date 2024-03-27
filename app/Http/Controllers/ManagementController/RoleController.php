<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\PermissionModel;
use App\Models\ManagementModel\RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny',RoleModel::class);
        $name_page = [
            'name' => 'Role Create',
            'total' => 'Role',
            'route' => 'role.index'
        ];
        $permissions = PermissionModel::all();
        $roles = RoleModel::all() ?? [];
        $groups = GroupModel::all();
        foreach($permissions as $permission){
            $name_route = explode('.',$permission->name);
            //dd($name_route);
            //Tạo mảng router CRUD ứng với từng chức năng vd Service['index','update','create','destroy']
            $arr_permissions[$name_route[0]][] =
            [
                'id' =>  $permission->id,
                'name' => $name_route[1] ??$name_route[0]
            ];
        }
        foreach($arr_permissions as $index => $value) {
            //loop mảng 2 chiều

            $array_permission[$index] = [];
            //sắp xếp mảng theo chức năng

            foreach($value as $key =>  $v ){
                //Sắp xếp lại thứ tự các value trong mảng router
                if($v['name'] === 'index'){
                    $arN[$index][0] = [
                        'id' => $arr_permissions[$index][$key]['id'],
                        'name' => $v['name']
                    ];
                }
                if($v['name'] === 'create'){
                    $arN[$index][1] = [
                        'id' => $arr_permissions[$index][$key]['id'],
                        'name' => $v['name']
                    ];
                }
                if($v['name'] === 'update'){
                    $arN[$index][2] = [
                        'id' => $arr_permissions[$index][$key]['id'],
                        'name' => $v['name']
                    ];
                }
                if($v['name'] === 'destroy'){
                    $arN[$index][3] = [
                        'id' => $arr_permissions[$index][$key]['id'],
                        'name' => $v['name']
                    ];
                }

            }
            //Sắp xếp lại thứ tự value của mảng
            ksort($arN[$index]);
            $array_permission[$index] = $arN[$index];

            //dd($array_permission,$arr_permissions);
        }
        return view('management.role.index',compact('array_permission','name_page','roles','groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function api(Request $request)
    {
        try {
            $roles = RoleModel::where('group_id',$request->group_id)->get()->all();
            $array_role = [];
            if($roles !== []){
                foreach($roles as $key => $role){
                    //dd($role->permission);
                    //dd($roles);
                    $array_role[$role->permission_id] = [
                        'checked' => 1,
                        'permission' => $role->permission_id
                    ];
                }
            }
            //dd($array_role);
            $array_role = json_encode($array_role);
            //dd($array_role);
            return response()->json($array_role);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

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
    public function show(RoleModel $roleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RoleModel $roleModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RoleModel $roleModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RoleModel $roleModel)
    {
        //
    }
}
