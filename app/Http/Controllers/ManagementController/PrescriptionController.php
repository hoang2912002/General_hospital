<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\AppointmentModel;
use App\Models\ManagementModel\BillDetailPrescriptionModel;
use App\Models\ManagementModel\BillDetailServiceModel;
use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\CategoryModel;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\MedicineModel;
use App\Models\ManagementModel\Number_medicalRecordModel;
use App\Models\ManagementModel\NumberModel;
use App\Models\ManagementModel\PrescriptionDetailModel;
use App\Models\ManagementModel\PrescriptionModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Support\Str;
class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(NumberModel $numberModel,UserModel $userModel,MedicalRecordModel $medical_recordModel)
    {
        $this->authorize('viewAny',PrescriptionModel::class);
        //dd($userModel,$medical_recordModel);
        $medicine = MedicineModel::get();
        $categories = CategoryModel::get();
        $manufacturers = ManufacturerModel::get();
        $prescription= PrescriptionModel::where('medical_record_id',$medical_recordModel->id)->first();
        $shift = ShiftModel::get();
        $check_number_medical_record = Number_medicalRecordModel::where([
            'number_id' => $numberModel->id,
            'patient_uuid' => $userModel->uuid,
            //'medical_record_id' => $medical_recordModel->id
        ])->first();
        if(empty($check_number_medical_record->medical_record_id)){
            //dd($number_medical_record,$userModel);
            $number_medical_record = $check_number_medical_record->update([
                'medical_record_id' => $medical_recordModel->id
            ]);
        }
        if($numberModel->status === 2 || $numberModel->status === 1){
            $numberModel->update([
                'status' => 3
            ]);
        }
        //dd($number_medical_record);
        return view('management/prescription/index',compact('numberModel','userModel','medical_recordModel','medicine','manufacturers','categories','prescription','shift'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function update_number_medical_record(NumberModel $numberModel,UserModel $userModel,MedicalRecordModel $medical_recordModel){
        try {
            //code...
            foreach($userModel->patients_identification as $patient_identification){
                $appointment = AppointmentModel::where([
                    ['first_name', '=', $userModel->first_name],
                    ['last_name', '=', $userModel->last_name],
                    ['gender', '=', $userModel->gender],
                    ['dob', '=', $userModel->dob],
                    ['email', '=', $userModel->login->email],
                    ['phone_number', '=', $userModel->login->phone_number],
                    ['patient_identification_code', '=', $patient_identification->patient_identification_code],
                    ['date', '=' , Carbon::today()->toDateString()],
                    ['status', '=', 2],
                ])->first();
                if(!empty($appointment)){
                    $appointment->update(['status'=>3]);
                }
            }

            if(!empty($numberModel) && !empty($userModel) && !empty($medical_recordModel)){
                $number_medical_record_model = Number_medicalRecordModel::where([
                    ['number_id',$numberModel->id],
                    ['patient_uuid',$userModel->uuid],
                    ['medical_record_id', $medical_recordModel->id]
                ])->first();
                //dd($number_medical_record_model);
                if(!empty($number_medical_record_model)){
                    $price_prescription = 0;
                    $price_service_result = 0;
                    $numberModel->update([
                        'status' => 4
                    ]);
                    $bill_check = BillModel::where([
                        ['medical_record_id',$medical_recordModel->id],
                        ['user_uuid',$userModel->uuid],
                    ])->get()->all();
                    if(empty($bill_check)){
                        //dd($medical_recordModel->service_result);
                        //dd($medical_recordModel->prescription->total_price,$medical_recordModel->id);
                        $bill = BillModel::create([
                            'user_uuid' => $userModel->uuid,
                            'medical_record_id' => $medical_recordModel->id,
                            'total_price' => null,
                            'payment_id' => null,
                            'transaction_id' => null,
                            'status' => 0,
                        ]);
                        if(!empty($bill)){
                            if(!empty($medical_recordModel->prescription)) {
                                $bill_detail_prescription = BillDetailPrescriptionModel::create([
                                    'bill_id' => $bill->id,
                                    'prescription_id' =>  $medical_recordModel->prescription->id,
                                    'price' => $medical_recordModel->prescription->total_price
                                ]);
                                $price_prescription = (int)$medical_recordModel->prescription->total_price;
                            }
                            foreach($medical_recordModel->service_result as $service_result ){
                                $bill_detail_service = BillDetailServiceModel::create([
                                    'bill_id' =>$bill->id,
                                    'service_result_id' =>$service_result->id,
                                    'price' => $service_result->price,
                                ]);
                                $price_service_result += (int)$service_result->price;

                            }

                            if(!empty($bill_detail_prescription) && !empty($bill_detail_service)){
                                $total_price = $price_service_result + $price_prescription;
                                $bill->update(['total_price' => $total_price]);
                            }

                        }
                        //dd($bill);
                    }
                    //dd($bill_check);
                    return redirect()->route('patient.index');
                }
            }
        }
        catch (\Throwable $th){
            dd($th->getMessage());
        }
            //dd('đa',$update_number_medicalRecord,$userModel,$medical_recordModel);


    }

    public function print_prescription(NumberModel $numberModel,UserModel $userModel,MedicalRecordModel $medical_recordModel){
        $prescription = PrescriptionModel::where('medical_record_id',$medical_recordModel->id)->first();
        //dd($prescription->prescription_detail);

        $pdf = FacadePdf::loadview('management.prescription.print_prescription',compact('prescription','userModel','medical_recordModel'))->setPaper('A4');
        return $pdf->download('benh-nhan-' . Str::slug($userModel->name()) . '-toa-thuoc' . '.pdf');
        //return view('management.prescription.print_prescription',compact('prescription','userModel','medical_recordModel'));
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
    public function service_result(MedicalRecordModel $medical_recordModel){
        if(!empty($medical_recordModel)){
            //dd($medical_recordModel->service_result);
            $service_result =$medical_recordModel->service_result;
            foreach($service_result as $index => $service){
                $service_result[$index]['service_name'] = $service->service->name;

            }
            //dd($service_result);
        }
        else{
            $service_result = null;

        }
        return response()->json($service_result);
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
