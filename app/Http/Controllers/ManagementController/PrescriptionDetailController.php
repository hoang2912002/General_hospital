<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\PrescriptionDetailModel;
use Illuminate\Http\Request;

class PrescriptionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(PrescriptionDetailModel $prescriptionDetailModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrescriptionDetailModel $prescriptionDetailModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrescriptionDetailModel $prescriptionDetailModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrescriptionDetailModel $prescriptionDetailModel)
    {
        try {
            if(!empty($prescriptionDetailModel)){
                $total_price = $prescriptionDetailModel->prescription_detail->total_price;
                //dd($total_price - $prescriptionDetailModel->medicine->price);
                $total_price_update = $prescriptionDetailModel->prescription_detail()->update([
                    'total_price' => $total_price - $prescriptionDetailModel->medicine->price,
                ]);
                if(!empty($total_price_update)){
                    $prescriptionDetailModel->delete();
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
