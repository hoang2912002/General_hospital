<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\CategoryModel;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\MedicineModel;
use App\Models\ManagementModel\PrescriptionDetailModel;
use App\Models\ManagementModel\PrescriptionModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(UserModel $userModel,MedicalRecordModel $medical_recordModel)
    {
        //dd($userModel,$medical_recordModel);
        $medicine = MedicineModel::get();
        $categories = CategoryModel::get();
        $manufacturers = ManufacturerModel::get();
        $prescription= PrescriptionModel::where('medical_record_id',$medical_recordModel->id)->first();
        $shift = ShiftModel::get();
        //dd($prescription->prescription_detail);
        return view('management/prescription/index',compact('userModel','medical_recordModel','medicine','manufacturers','categories','prescription','shift'));
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
        //dd($request);
        try {
            if(!empty($request->arr_prescription)){
                $totalPrice = 0;
                //Vòng lập tính tổng tiền
                foreach($request->arr_prescription as $total_price){
                    $totalPrice += (int) $total_price['price'];
                }
                $check_prescription = PrescriptionModel::where('medical_record_id', $request->arr_prescription[0]['medical_record_id'])->first();
                if(empty($check_prescription)){
                    $prescription = PrescriptionModel::create([
                        'medical_record_id' => $request->arr_prescription[0]['medical_record_id'],
                        'total_price' => $totalPrice,
                        'note' => ''
                    ]);
                    if(!empty($prescription)){
                        foreach($request->arr_prescription as $each){
                            $prescription_detail = PrescriptionDetailModel::create([
                                'medicine_id' => $each['id'],
                                'prescription_id' => $prescription->id,
                                'quantity' => $each['quantity'],
                                'price' => $each['price'],
                                'note' => $each['description']
                            ]);
                        }
                        if(!empty($prescription_detail)){
                            return response()->json(['status' => "success"]);
                        }
                    }
                }
                else{
                    $prescription = PrescriptionModel::query()
                    ->where('id', $check_prescription->id)
                    ->update(['total_price' => $totalPrice]);
                    if(!empty($check_prescription->prescription_detail)){
                        $delete_data = $check_prescription->prescription_detail()->delete();
                    }
                    foreach($request->arr_prescription as $each){
                        $prescription_detail = PrescriptionDetailModel::create([
                            'medicine_id' => $each['id'],
                            'prescription_id' => $check_prescription->id,
                            'quantity' => $each['quantity'],
                            'price' => $each['price'],
                            'note' => $each['description']
                        ]);
                    }
                    if(!empty($prescription_detail)){
                        //dd(1);
                        return response()->json(['status' => "success"]);
                    }
                }
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(PrescriptionModel $prescriptionModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PrescriptionModel $prescriptionModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PrescriptionModel $prescriptionModel)
    {
        //
    }

    public function detail_medicine(MedicineModel $medicineModel){
        dd($medicineModel);
    }

    public function select_medicine(Request $request){
        dd($request);
    }
    public function render_medicine(Request $request){
        $prescription_details = PrescriptionDetailModel::where('prescription_id',$request->prescription)->get()->toArray();
        $array_id_prescription_details =  array_column($prescription_details, 'medicine_id');
        if(!empty($request->searchTerm)){
            $medicine = MedicineModel::where('name', 'like', '%' . $request->searchTerm . '%')
            ->with(['manufacturer' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['categories' => function ($query) {
                $query->select('id', 'name','slug');
            }])
            ->get();
            foreach($medicine as $index => $item){
                if (in_array($item->id, $array_id_prescription_details)) {
                    $medicine[$index]['checkbox'] = 1;
                }
            }
        }
        else{
            $medicine = MedicineModel::
            with(['manufacturer' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['categories' => function ($query) {
                $query->select('id', 'name','slug');
            }])->get();
            foreach($medicine as $index => $item){
                if (in_array($item->id, $array_id_prescription_details)) {
                    $medicine[$index]['checkbox'] = 1;
                }
            }
        }
        return response()->json($medicine);
    }

    public function category_select_medicine(Request $request){
        $prescription_details = PrescriptionDetailModel::where('prescription_id',$request->prescription)->get()->toArray();
        $array_id_prescription_details =  array_column($prescription_details, 'medicine_id');
        if($request->category_selected != '' || !empty($request->category_selected)){
            $category = CategoryModel::where('slug', $request->category_selected)->first();
            $medicine = MedicineModel::where('category_id', $category->id)
            ->with(['categories' => function ($query) {
                $query->select('id', 'name','slug');
            }])
            ->with(['manufacturer' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();
            foreach($medicine as $index => $item){
                //dd($item);
                if (in_array($item->id, $array_id_prescription_details)) {
                    $medicine[$index]['checkbox'] = 1;
                }
            }//dd($medicine);
        }
        else{
            //dd($request);
            $medicine = MedicineModel::
            with(['manufacturer' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['categories' => function ($query) {
                $query->select('id', 'name','slug');
            }])->get();
            foreach($medicine as $index => $item){
                if (in_array($item->id, $array_id_prescription_details)) {
                    $medicine[$index]['checkbox'] = 1;
                }
            }
            //dd($medicine);
        }
        return response()->json($medicine);
    }
    public function manufacturer_select_medicine(Request $request){
        $prescription_details = PrescriptionDetailModel::where('prescription_id',$request->prescription)->get()->toArray();
        $array_id_prescription_details =  array_column($prescription_details, 'medicine_id');
        if($request->manufacturer_selected != '' || !empty($request->manufacturer_selected)){
            $manufacturer = ManufacturerModel::where('id', $request->manufacturer_selected)->first();
            $medicine = MedicineModel::where('manufacturer_id', $manufacturer->id)
            ->with(['categories' => function ($query) {
                $query->select('id', 'name','slug');
            }])
            ->with(['manufacturer' => function ($query) {
                $query->select('id', 'name');
            }])
            ->get();

            foreach($medicine as $index => $item){
                //dd($item);
                if (in_array($item->id, $array_id_prescription_details)) {
                    $medicine[$index]['checkbox'] = 1;
                }
            }//dd($medicine);
        }
        else{
            //dd($request);
            $medicine = MedicineModel::
            with(['manufacturer' => function ($query) {
                $query->select('id', 'name');
            }])
            ->with(['categories' => function ($query) {
                $query->select('id', 'name','slug');
            }])->get();
            foreach($medicine as $index => $item){
                if (in_array($item->id, $array_id_prescription_details)) {
                    $medicine[$index]['checkbox'] = 1;
                }
            }
            //dd($medicine);
        }
        return response()->json($medicine);
    }

    public function render_note_medicine(Request $request){
        $prescription_details = PrescriptionDetailModel::where('prescription_id',$request->prescription)->get()->toArray();
        $array_id_prescription_details =  array_column($prescription_details, 'medicine_id');
        $array_prescription_details =  array_column($prescription_details, NULL,'medicine_id');
        if(!empty($request->array_checkbox)){
            foreach($request->array_checkbox as $index => $checkbox){
                $medicine = MedicineModel::where('slug',$checkbox)->first();
                //dd($array_id_prescription_details,$request->array_checkbox, $array_prescription_details[$medicine->id]);
                $medicine_array[] = '
                <div class="row div_content_each_prescription" id="div_content_each_prescription" >
                    <div class="col-12 col-sm-3">
                        <div class="form-check form-switch ps-0">
                            <input type="hidden" value="' . $medicine->id . '" id="id_medicine" name="id_medicine[]">
                            <input type="hidden" value="' . $medicine->price . '" id="slug_medicine" name="price[]">
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for=""><h6>' . $medicine->name . ' </h6></label>
                        </div>
                    </div>
                    <div class="col-12 col-sm-2">
                        <label for="">Số lượng</label>
                        <input class="multisteps-form__input form-control" type="text" id="quantity" placeholder="Nhập số lượng" name="quantity[]"
                        value="' . (in_array($medicine->id, $array_id_prescription_details) ? $array_prescription_details[$medicine->id]['quantity'] : '') . '">
                    </div>
                    <div class="col-12 col-sm-7">
                        <label class="">Thông tin chi tiết</label>
                        <p class="form-text text-muted text-xs ms-1 d-inline">
                        (optional)
                        </p>
                        <div id="edit-deschiption" class="h-50">
                            <p><strong>'. (in_array($medicine->id, $array_id_prescription_details) ? $array_prescription_details[$medicine->id]['note'] : 'Vui lòng điền rõ liều lượng thuốc sử dụng') .'</strong> </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer mt-4"></div>';
            }
            return response()->json($medicine_array);
        }

    }

    public function update_medical_record(Request $request, MedicalRecordModel $medical_recordModel){
        //dd($request,$medical_recordModel);
        try {
            $medical_record_data = $medical_recordModel->update([
                'reason' => $request->reason,
                'weight' => $request->weight,
                'height' => $request->height,
                'vessel' => $request->vessel,
                'blood_pressure' => $request->blood_pressure,
                'temperature' => $request->temperature,
                'note' => $request->note,
                'disease' => $request->disease,
                'exam_date' => $request->exam_date,
                'shift_id' => $request->shift_id ,
            ]);
            if(!empty($medical_record_data)){
                return redirect()->back()->with('reload' , 'Cập nhập hồ sơ bệnh án thành công!');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('reload-error');
        }
    }
    public function update_re_exam_date(Request $request, MedicalRecordModel $medical_recordModel){
        //dd($request,$medical_recordModel);
        try {
            $medical_record_data = $medical_recordModel->update([
                're_exam_date' => $request->re_exam_date,
                'note' => $request->note,
            ]);
            if(!empty($medical_record_data)){
                return redirect()->back()->with('reload-error');
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PrescriptionModel $prescriptionModel)
    {
        //
    }
}
