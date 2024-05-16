<?php

namespace App\Http\Controllers\ManagementController;

use App\Exports\ExcelExportUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\UserRequest\StoreRequest;
use App\Http\Requests\ManagementRequest\UserRequest\UpdateRequest;
use App\Imports\ExcelImportUsers;
use App\Models\ManagementModel\StaffModel;
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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',UserModel::class);
        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Người dùng',
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
        $this->authorize('create',UserModel::class);
        $name_page = [
            'name' => 'Thêm',
            'total' => 'Người dùng',
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
            //dd($request);
            $login = LoginModel::create([
                'email' => $request->arr['email'],
                'phone_number' => $request->arr['phone_number'],
                'password' => bcrypt($request->arr['password']),
                'activated' => 1
            ]);
            if(!empty($login)){
                $arr_user = [
                    'uuid' => (string)Str::uuid(),
                    'first_name' =>$request->arr['first_name'],
                    'last_name' =>$request->arr['last_name'],
                    'gender' =>$request->arr['gender'],
                    'dob' => $request->arr['dob'],
                    'login_id' => $login->id,
                ];
                //dd($arr_user);
                $user = UserModel::create($arr_user);
                if(!empty($user)){
                    $role = GroupUserModel::create([
                        'user_uuid' => $user->uuid,
                        'group_id' => $request->arr['role'],
                    ]);
                    if(!empty($role)){
                        if(!empty($request->arr['description']) && !empty($request->arr['image'])){
                            $newStr = str_replace('<p><br></p>', "", $request->arr['description']);
                            $newStr = str_replace('<p><strong>  </strong></p>', "", $newStr);
                            $newStr = str_replace('<p><strong> </strong> </p>', "", $newStr);
                            $newStr = str_replace("\u{FEFF}", "", $newStr);
                            $staffInformation= [
                                'staff_uuid'=> $user->uuid,
                                'image'=> $request->arr['image'],
                                'description'=> $request->arr['description'],
                            ];
                            $staff = StaffModel::create($staffInformation);

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
        if(!empty($request->file('file'))){
            $path = $request->file("file")->getRealPath();
            //dd($path);
            Excel::import(new ExcelImportUsers, $path);
            return back();
        }
        else{
            return back()->with('error','Vui lòng chọn file excel');
        }


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
        $this->authorize('update',$userModel);
        $name_page = [
            'name' => 'Cập nhật',
            'total' => 'Người dùng',
            'route' => 'user.index'
        ];
        $groups = GroupModel::all();
        // $login = $userModel->login();
        // $staff = $userModel->staff;
        // dd($userModel->group_user->all()[0]->id);
        return view('management.user.update',compact('name_page','groups','userModel'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, UserModel $userModel)
    {
        try {
            $password = $userModel->login->password;

            $arr_login = [
                'email' => $request->arr['email'],
                'phone_number' => $request->arr['phone_number'],

            ];
            if($request->arr['password'] !== null){
                $password = $request->password;
                $arr_login['password'] = $password;
            }
            //dd($request->password === null,$arr_login);
            $login = $userModel->login->update($arr_login);
            if(!empty($login)){
                $arr_user = [
                    'first_name' => $request->arr['first_name'],
                    'last_name' => $request->arr['last_name'],
                    'gender' => $request->arr['gender'],
                    'dob' => $request->arr['dob'],
                    'login_id' => $userModel->login_id,
                ];
                $user = $userModel->update($arr_user);
                if(!empty($user)){
                    $group_name = GroupModel::where('id',$request->arr['role'])->value('name');
                    $role = $userModel->group_user()->update([
                        'user_uuid' => $userModel->uuid,
                        'group_id' => $request->arr['role']
                    ]);
                    if(!empty($role)){
                        $staffInformation= [
                            'staff_uuid'=> $userModel->uuid,
                            'description'=> $request->arr['description'],
                        ];
                        //DD($staffInformation);
                        if(!empty($request->arr['image'])){
                            $staffInformation['image']= $request->arr['image'];
                            //dd($userModel->staff);
                            if(!empty($userModel->staff)){
                                $staff = $userModel->staff()->update($staffInformation);
                            }
                            else{
                               $staff = StaffModel::create($staffInformation);
                            }
                            //dd($request->arr,$staff);
                        }
                        else{
                            //dd(2);
                            $staff = $userModel->staff()->update($staffInformation);
                        }
                        // if(!empty($staff)){
                        //     dd($staff);
                        //     return redirect()->route('user.index')->with('success' , 'Cập nhập thông tin ' . $request->first_name . ' ' . $request->last_name . ' thành công!');
                        // }

                    }
                }
            }

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function detail(UserModel $userModel){
        $name_page = [
            'name' => 'User Detail',
            'total' => 'User',
            'route' => 'user.index'
        ];
        $role =$userModel->group_user->all();
        $staff = $userModel->staff ?? '';
        //dd($role[0]->name);
        return view('management.user.detail',compact('name_page','role','staff','userModel'));
        //dd($userModel->group_user,$userModel->staff);
    }
    public function setting(){
        $name_page = [
            'name' => 'Cài Đặt Cá Nhân',
            'total' => 'User',
            'route' => 'user.index'
        ];
        return view('management.user.setting',compact('name_page'));
    }
    public function profile(){
        return view('management.user.profile');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function readFiles(Request $request,UserModel $userModel){
        try {
            if(!empty($userModel)){
                $name_image= explode('/',$userModel->staff->image) ?? '';
                $file_size = '';
                if($userModel->staff->image !== ''){
                    $file_size = filesize($userModel->staff->image);
                }
                $arr[] = [
                    'image' => asset($userModel->staff->image ?? ''),
                    'name' => $name_image[4] ?? '',
                    'size' => $file_size,
                ];
                return response()->json(['status' => "success",'arr' => $arr]);
            }

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function save_image(Request $request){
        try {
            if($request->hasFile('file')){
                //dd('1',$request);
                //dd(1);
                $files = $request->file;
                foreach($files as $file){
                    $namefile = $file->getClientOriginalName();
                    $dirFolder = 'img/general_hospital/management/avatar/';
                    $newfile = $dirFolder . Carbon::now()->getTimestampMs() . '-' . $namefile;
                    //dd(1);

                    $user_image[]= $newfile;
                    if(!empty($file)){
                        $file->move($dirFolder, $newfile);
                    }
                }
                //dd($medicine_image);
            }
            return response()->json(['status' => "success",'message' => "Lưu file thành công",'medicine_image' => $newfile,'arr_image' => $user_image]);
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    public function delete_image(Request $request,UserModel $userModel){
        try {
            if(!empty($userModel->staff->image)){
                $name_image= explode('/',$request->filename[0]) ?? '';
                unset($name_image[0], $name_image[1],$name_image[2]);
                $name_image = implode('/',$name_image);
                if($userModel->staff->image === $request->filename || file_exists($userModel->staff->image)){
                    unlink($userModel->staff->image);
                    $userModel->staff->update([
                        'image' => ''
                    ]);
                }
            }
            else{
                //Kiểm tra coi nếu path 1 có ảnh trong project thì xóa k thì sẽ qa path 2 vì $request sẽ lưu cả ảnh đã bị xóa r nên phải làm v
                $path = public_path(). '/' .  $request->filename[0];
                if(file_exists($path)){
                    File::delete($path);
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function delete_imageCreate( Request $request){
        try {
            if(!empty($request->filename[0])){
                //dd($request);
                $path = public_path(). '/' .  $request->filename[0];
                if(file_exists($path)){
                    File::delete($path);
                }
            }

        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function destroy(UserModel $userModel)
    {
        try {
            $this->authorize('delete',$userModel);
            //dd($userModel->login_id,LoginModel::where('id',$userModel->login_id)->delete());
            //làm phương thức xóa ảnh
            if(!empty($userModel->staff)){
                $staff = $userModel->staff()->delete();
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
