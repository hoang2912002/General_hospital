<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\BillManagementModel;
use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class BillManagementController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny',BillManagementModel::class);
        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Hóa đơn',
            'route' => 'bill.index'
        ];
        if($request->ajax()){
            $bills = BillModel::get();
            return DataTables::of($bills)
            ->editColumn('id', function ($bill) {
                return $bill->id;
            })
            ->editColumn('full_name', function ($bill) {

                return $bill->user->name();
            })
            ->editColumn('dob', function ($bill) {

                return $bill->user->dob();
            })
            ->editColumn('phone_number', function ($bill) {

                return $bill->user->login->phone_number;
            })
            ->editColumn('total_price', function ($bill) {
                return $bill->total_price();
            })
            ->editColumn('status', function ($bill) {
                return $bill->status();
            })
            ->addColumn('action', function ($bill) {
                //$routeDestroy = "'" . route('bill.destroy',$bill->uuid) . "'";
                $route_edit =  '<a href="'. route('bill_management.edit', $bill->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_detail =  '<a href="'. route('bill_management.detail', $bill->id) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';

                //$route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail;
            })

            ->rawColumns(['id','full_name','dob','phone_number','total_price','status','action'])
            ->make();
        }
        return view('management.bill.index_management',compact('name_page'));
    }

    public function create(){

    }

    public function edit(BillModel $billModel){
        $this->authorize('update',$billModel);
        $name_page = [
            'name' => 'Sửa',
            'total' => 'Hóa đơn',
            'route' => 'bill.index'
        ];
        return view('management.bill.update_management',compact('name_page','billModel'));
    }

    public function update(Request $request, BillModel $billModel){
        try {
            $bill = $billModel->update($request->all());
            if(!empty($bill)){
                return redirect()->route('bill_management.index')->with('success' , 'Cập nhật hóa đơn thành công!' );
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error' , 'Cập nhật hóa đơn thất bại!' );
        }
    }
}
