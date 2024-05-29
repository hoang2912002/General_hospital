<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Http\Requests\ManagementRequest\LoginRequest\LoginRequest;
use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomepageController extends Controller
{
    public function index(){
        //$this->authorize('viewAny',HomepageController::class);
        $name_page = [
            'name' => 'Trang chủ',
            'total' => 'Dashboard',
            'route' => 'index'
        ];
        $bill = '';
        $doctor = '';
        $patient = '';

        if(Auth::user()->User->group_user[0]->slug === 'quan-ly'){
            $patient = UserModel::whereHas('gr_user', function ($query) {
                $query->whereHas('groups', function ($query){
                    $query->where('slug', 'benh-nhan');
                }); // hoặc where('name', 'Doctor')
            })->count();
            $doctor = UserModel::whereHas('gr_user', function ($query) {
                $query->whereHas('groups', function ($query){
                    $query->where('slug', 'bac-si');
                }); // hoặc where('name', 'Doctor')
            })->count();
            $bill = BillModel::where('status', 1)->sum('total_price');
        }

        $shift = ShiftModel::get();
        return view('management.homepage',compact('name_page','shift','patient','doctor','bill'));
    }

    public function not_found(){
        return view('management.layout.403');
    }
}
