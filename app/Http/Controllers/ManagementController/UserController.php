<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\UserRequest\StoreRequest;
use App\Models\ManagementModel\DoctorModel;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\GroupUserModel;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name_page = [
            'name' => 'User Index',
            'total' => 'User',
            'route' => 'user.index'
        ];

        if($request->ajax()){

            $users = UserModel::get();

            return DataTables::of($users)
            ->editColumn('uuid', function ($user) {
                return $user->uuid;
            })
            ->editColumn('first_name', function ($user) {

                return $user->first_name;
            })
            ->editColumn('last_name', function ($user) {

                return $user->last_name;
            })
            ->editColumn('gender', function ($user) {
                return $user->gender();
            })
            ->editColumn('dob', function ($user) {
                return $user->dob   ();
            })
            ->editColumn('email', function ($user) {
                return $user->login->email;
            })
            ->editColumn('phone_number', function ($user) {
                return $user->login->phone_number;
            })
            ->addColumn('action', function ($user) {
                $routeDestroy = "'" . route('user.destroy',$user->uuid) . "'";
                $route_edit =  '<a href="'. route('user.edit', $user->uuid) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_delete;
            })

            ->rawColumns(['uuid','first_name','last_name','gender','dob','email','phone_number','action'])
            ->make();
        }
        return view('management.user.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $name_page = [
            'name' => 'User Index',
            'total' => 'User',
            'route' => 'user.index'
        ];
        $groups = GroupModel::get()->all();
        return view('management.user.create',compact('name_page','groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {
            //dd($request->last_name);
            $login = LoginModel::create($request->only('email','phone_number','password','activated'));
            if(!empty($login)){
                $arr_user = [
                    'uuid' => (string)Str::uuid(),
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'dob' => $request->birthdate,
                    'login_id' => $login->id,
                ];
                //dd($arr_user);
                $user = UserModel::create($arr_user);
                if(!empty($user)){
                    $role = GroupUserModel::create([
                        'user_uuid' => $user->uuid,
                        'group_id' => $request->role,
                    ]);
                    if(!empty($role)){
                        if($request->hasFile('avatar')){
                            $avatar = $request->avatar;
                            $nameAvatar = $avatar->getClientOriginalName();
                            $dirFolder = 'img/general_hospital/management/avatar';
                            $newAvatar = $dirFolder . $user->uuid . '-' . $nameAvatar;

                            $doctorInformation= [
                                'doctor_uuid'=> $user->uuid,
                                'image'=> $newAvatar,
                                'description'=> $request->description,
                            ];
                            @unlink($newAvatar);
                            $doctor = DoctorModel::create($doctorInformation);
                            if(!empty($doctor)){
                                if(!empty($avatar)){
                                    $avatar->move($dirFolder, $newAvatar);

                                }
                            }
                        }
                        return redirect()->route('user.index')->with('success' , 'Thêm' . $request->first_name . $request->last_name  . 'thành công!' );
                    }
                }
            }
            //dd($request);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserModel $userModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserModel $userModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserModel $userModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserModel $userModel)
    {
        //
    }
}
