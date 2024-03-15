<?php

namespace App\Http\Controllers\ManagementController;

use App\Exports\ExcelExportUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\UserRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\UserRequest\UpdateRequest;
use App\Imports\ExcelImportUsers;
use App\Models\ManagementModel\DoctorModel;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\GroupUserModel;
use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel as ExcelExcel;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
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
                $route_detail =  '<a href="'. route('user.detail', $user->uuid) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';

                $route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail . '&nbsp'  . $route_delete;
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
            'name' => 'User Create',
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
                            $dirFolder = 'img/general_hospital/management/avatar/';
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
    public function import(Request $request)
    {

        $path = $request->file("file")->getRealPath();
        //dd($path);
        Excel::import(new ExcelImportUsers, $path);
        return back();

    }
    public function export()
    {
        return Excel::download(new ExcelExportUsers , 'user-'  . date('s_i_H-Y_m_d') .  '.xlsx');
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
        $name_page = [
            'name' => 'User Update',
            'total' => 'User',
            'route' => 'user.index'
        ];
        $groups = GroupModel::all();
        // $login = $userModel->login();
        // $doctor = $userModel->doctor;
        // dd($userModel->group_user->all()[0]->id);
        return view('management.user.update',compact('name_page','groups','userModel'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, UserModel $userModel)
    {
        try {
            //dd($request,$userModel->login);
            $arr_login = [
                'email' => $request->email,
                'phone_number' => $request->phone_number,

            ];
            if($request->password !== null){
                $password = $request->password;
                $arr_login['password'] = $password;
            }
            //dd($request->password === null,$arr_login);
            $login = $userModel->login->update($arr_login);
            if(!empty($login)){
                $arr_user = [
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'gender' => $request->gender,
                    'dob' => $request->birthdate,
                    'login_id' => $userModel->login_id,
                ];
                $user = $userModel->update($arr_user);
                if(!empty($user)){
                    $group_name = GroupModel::where('id',$request->role)->value('name');
                    $role = $userModel->group_user()->update([
                        'user_uuid' => $userModel->uuid,
                        'group_id' => $request->role
                    ]);
                    if(!empty($role)){
                        $doctorInformation= [
                            'doctor_uuid'=> $userModel->uuid,
                            'description'=> $request->description,
                        ];
                        //DD($doctorInformation);
                        if($request->hasFile('avatar')){
                            //dd(1);
                            $avatar = $request->avatar;
                            $nameAvatar = $avatar->getClientOriginalName();
                            $dirFolder = 'img/general_hospital/management/avatar/';
                            $newAvatar = $dirFolder . $userModel->uuid . '-' . $nameAvatar;
                            //dd(1);

                            $doctorInformation['image']= $newAvatar;
                            //dd($doctorInformation);
                            if(!empty($userModel->image)){
                                @unlink($userModel->image);
                            }
                            $doctor = $userModel->doctor()->updateOrCreate($doctorInformation);
                            if(!empty($doctor)){
                                if(!empty($avatar)){
                                    $avatar->move($dirFolder, $newAvatar);

                                }
                            }
                        }
                        else{
                            $doctor = $userModel->doctor()->update($doctorInformation);
                        }

                        return redirect()->route('user.index')->with('success' , 'Cập nhập thông tin ' . $group_name . ' ' . $request->first_name . ' ' . $request->last_name . ' thành công!');
                    }
                }
            }

        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function detail(UserModel $userModel){
        $name_page = [
            'name' => 'User Detail',
            'total' => 'User',
            'route' => 'user.index'
        ];
        $role =$userModel->group_user->all();
        $doctor = $userModel->doctor ?? '';
        //dd($role[0]->name);
        return view('management.user.detail',compact('name_page','role','doctor','userModel'));
        //dd($userModel->group_user,$userModel->doctor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserModel $userModel)
    {
        try {
            //dd($userModel->login_id,LoginModel::where('id',$userModel->login_id)->delete());
            //làm phương thức xóa ảnh
            if(!empty($userModel->doctor)){
                $doctor = $userModel->doctor()->delete();
            }
            $role = $userModel->gr_user()->delete();
            if(!empty($role)){
                if($userModel->delete()){
                    LoginModel::where('id',$userModel->login_id)->delete();
                    //$userModel->login()->delete();
                    return 1;
                }
            }
            else{
                return 0;
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
