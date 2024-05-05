<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\Number_medicalRecordModel;
use App\Models\ManagementModel\NumberModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$this->authorize('viewAny',UserModel::class);
        $name_page = [
            'name' => 'User Index',
            'total' => 'User',
            'route' => 'user.index'
        ];

        if($request->ajax()){

            // $numbers = NumberModel::where([
            //     ['status',3],
            // ])->get();
            $numbers = NumberModel::where('status', 3)
            ->with('number_medical_record') // Sử dụng eager loading để tải các bản ghi từ Number_medicalRecordModel liên quan
            ->get();
            // foreach($numbers as $number){
            //     $arr[] = Number_medicalRecordModel::where([
            //         ['number_id',$number->id],
            //     ])->get()->all();
            // }
            return DataTables::of($numbers)
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
        //
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
    public function show(BillModel $billModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BillModel $billModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BillModel $billModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillModel $billModel)
    {
        //
    }
}
