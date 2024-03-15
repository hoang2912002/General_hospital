<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\LoginRequest\LoginRequest;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\LoginModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login()
    {
        if(Auth::check()){
            return view('management.homepage');
        }

        return view('management.layout.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function processLogin(LoginRequest $request){
        $login = LoginModel::where('email',$request->email)->first();
        //dd($login->password);
        $error = 'Tài khoản không đúng';
        if(!empty($login)){
            if (Hash::check($request->password, $login->password)) {
                $RoleUser = $login->User->group_user[0]->slug;
                $groups = GroupModel::get();
                $arrUser = ['benh-nhan','user','nguoi-dung'];
                $arrRoles = [];
                foreach($groups as $group){
                    //dd($arrR);
                    if(!in_array($group,$arrUser)){
                        $arrRoles[] = $group->slug;
                    }
                }
                if(in_array($RoleUser,$arrRoles)){
                    //dd(Auth::attempt($request->only(['email','password']),$request->remember));
                    $check = Auth::attempt($request->only(['email','password']),$request->remember);
                    //dd(1);
                    if($check){
                        return redirect()->route('index')->with('success' , 'Đăng nhập thành công!');
                    }
                    else{
                        return redirect()->route('login.index')
                    ->with(['error' => 'Tài khoản mật khẩu không chính xác']);
                    }
                }
                else{
                    return redirect()->route('login.index')
                    ->with(['error' => 'Tài khoản mật khẩu không chính xác']);
                }
                // dd($arrRoles);
                // dd(in_array($RoleUser,$arrRoles));
            }
            else{
                return redirect()->back()
            ->with(['password' => 'Mật khẩu không chính xác']);
            }
        }
        else{
            return redirect()->back()
            ->with(['email' => 'Tài khoản mật khẩu không chính xác']);
        }
        // dd($login);
        // if(!empty($login)){

        // }
        // dd($request);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LoginModel $loginModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LoginModel $loginModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LoginModel $loginModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LoginModel $loginModel)
    {
        //
    }
}
