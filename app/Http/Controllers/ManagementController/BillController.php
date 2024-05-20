<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\Number_medicalRecordModel;
use App\Models\ManagementModel\NumberModel;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Support\Str;
class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny',BillModel::class);
        $name_page = [
            'name' => 'Danh sách',
            'total' => 'Hóa đơn',
            'route' => 'bill.index'
        ];
        if($request->ajax()){
            $bills = BillModel::where('status', 0)->get();
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
                $route_edit =  '<a href="'. route('bill.edit', $bill->id) .'" class="badge bg-gradient-secondary"><i class="fas fa-edit"></i></a>';
                $route_detail =  '<a href="'. route('bill.detail', $bill->id) .'" class="badge bg-gradient-success"><i class="fas fa-solid fa-file"></i></a>';

                //$route_delete = '<a href="javascript:void(0)" class="badge bg-gradient-danger" onclick="deleteItem('. $routeDestroy .')"><i class="fas fa-trash"></i></a>';
                return $route_edit . '&nbsp' . $route_detail;
            })

            ->rawColumns(['id','full_name','dob','phone_number','total_price','status','action'])
            ->make();
        }
        return view('management.bill.index',compact('name_page'));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function detail(BillModel $billModel){
        $name_page = [
            'name' => 'Chi tiết',
            'total' => 'Hóa đơn',
            'route' => 'bill.index'
        ];
        //dd($billModel->bill_service_result);
        $isActiveTab1 = true;
        return view('management.bill.detail',compact('name_page','billModel','isActiveTab1'));
    }

    public function print_pdf_bill(BillModel $billModel){
        //return view('management.bill.print_pdf_bill',compact('billModel'));
        $pdf = FacadePdf::loadview('management.bill.print_pdf_bill',compact('billModel'))->setPaper('A4');
        return $pdf->download('hoa-don-benh-nhan-'. Str::slug($billModel->user->name()) . '.pdf');
    }

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


    public function update_status(Request $request, BillModel $billModel){
        //dd($request);
        try {
            if(!empty($request->status)){
                $status = $billModel->update(['status' => $request->status]);
                if(!empty($status)){
                    return redirect()->back()->with('success','Thanh toán thành công!');
                }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Thanh toán thất bại!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BillModel $billModel)
    {
        //
    }
}
