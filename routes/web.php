<?php

use App\Http\Controllers\ManagementController\AssignmentController;
use App\Http\Controllers\ManagementController\BillController;
use App\Http\Controllers\ManagementController\CategoryController;
use App\Http\Controllers\ManagementController\DepartmentController;
use App\Http\Controllers\ManagementController\EquipmentCategoryController;
use App\Http\Controllers\ManagementController\GroupController;
use App\Http\Controllers\ManagementController\HomepageController;
use App\Http\Controllers\ManagementController\LoginController;
use App\Http\Controllers\ManagementController\ManufacturerController;
use App\Http\Controllers\ManagementController\MedicalEquipmentController;
use App\Http\Controllers\ManagementController\MedicalRecordController;
use App\Http\Controllers\ManagementController\MedicineController;
use App\Http\Controllers\ManagementController\MedicineTypeController;
use App\Http\Controllers\ManagementController\NumberController;
use App\Http\Controllers\ManagementController\PatientController;
use App\Http\Controllers\ManagementController\PrescriptionController;
use App\Http\Controllers\ManagementController\PrescriptionDetailController;
use App\Http\Controllers\ManagementController\RoleController;
use App\Http\Controllers\ManagementController\RoomController;
use App\Http\Controllers\ManagementController\ServiceController;
use App\Http\Controllers\ManagementController\ShiftController;
use App\Http\Controllers\ManagementController\test_requisitionController;
use App\Http\Controllers\ManagementController\TestRequisitionController;
use App\Http\Controllers\ManagementController\UserController;
use App\Http\Middleware\CheckLogin;
use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicineModel;
use App\Models\ManagementModel\MedicineTypeModel;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/linkstorage', function () {
//     Artisan::call('storage:link');
// });

Route::group(['controller' => LoginController::class, 'prefix' => 'login', 'as' => 'login.'],function(){
    Route::get('/', 'login')->name('index');
    Route::post('process', 'processLogin')->name('processLogin');
    Route::get('logout', 'logout')->name('logout');
});

Route::middleware([CheckLogin::class])->group(function(){
    //Homepage

    Route::get('/',[HomepageController::class,'index'])->name('index');
    Route::get('/not-found',[HomepageController::class,'not_found'])->name('not_found');

    //Group
    Route::group(['controller' => GroupController::class, 'prefix' => 'group', 'as' => 'group.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::patch('update/{groupModel}', 'update')->name('update');
        Route::get('edit/{groupModel}', 'edit')->name('edit');
        Route::delete('destroy/{groupModel}', 'destroy')->name('destroy');
        Route::post('import', 'import')->name('import');
        Route::post('export', 'export')->name('export');
    });
    //User
    Route::group(['controller' => UserController::class, 'prefix' => 'user', 'as' => 'user.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{userModel}', 'edit')->name('edit');
        Route::get('detail/{userModel}', 'detail')->name('detail');
        Route::patch('update/{userModel}', 'update')->name('update');
        Route::delete('destroy/{userModel}', 'destroy')->name('destroy');
        Route::post('import', 'import')->name('import');
        Route::post('export', 'export')->name('export');
        Route::get('profile','profile')->name('profile');
        Route::get('setting','setting')->name('setting');
        Route::post('save_image', 'save_image')->name('save_image');
        Route::get('readFiles/{userModel}', 'readFiles')->name('readFiles');
        Route::post('delete_image/{userModel}', 'delete_image')->name('delete_image');
        Route::post('delete_imageCreate', 'delete_imageCreate')->name('delete_imageCreate');
    });
    //Service
    Route::group(['controller' => ServiceController::class, 'prefix' => 'service', 'as' => 'service.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::post('dropzone', 'dropzone')->name('dropzone');
        Route::get('readFiles/{serviceModel}', 'readFiles')->name('readFiles');
        Route::get('readFilesThumbnail/{serviceModel}', 'readFilesThumbnail')->name('readFilesThumbnail');
        Route::get('edit/{serviceModel}', 'edit')->name('edit');
        Route::get('detail/{serviceModel}', 'detail')->name('detail');
        Route::patch('update/{serviceModel}', 'update')->name('update');
        Route::delete('destroy/{serviceModel}', 'destroy')->name('destroy');
        Route::post('import', 'import')->name('import');
        Route::post('export', 'export')->name('export');
    });
    //Category
    Route::group(['controller' => CategoryController::class, 'prefix' => 'category', 'as' => 'category.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{categoryModel}', 'edit')->name('edit');
        Route::patch('update/{categoryModel}', 'update')->name('update');
        Route::delete('destroy/{categoryModel}', 'destroy')->name('destroy');
    });
    //Medicine
    Route::group(['controller' => MedicineController::class, 'prefix' => 'medicine', 'as' => 'medicine.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{medicineModel}', 'edit')->name('edit');
        Route::patch('update/{medicineModel}', 'update')->name('update');
        Route::get('detail/{medicineModel}', 'detail')->name('detail');
        Route::delete('destroy/{medicineModel}', 'destroy')->name('destroy');
        Route::post('save_image', 'save_image')->name('save_image');
        Route::get('readFiles/{medicineModel}', 'readFiles')->name('readFiles');
        Route::post('delete_image/{medicineModel}', 'delete_image')->name('delete_image');
        Route::post('delete_imageCreate', 'delete_imageCreate')->name('delete_imageCreate');
    });
    //Manufacturer
    Route::group(['controller' => ManufacturerController::class, 'prefix' => 'manufacturer', 'as' => 'manufacturer.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{manufacturerModel}', 'edit')->name('edit');
        Route::patch('update/{manufacturerModel}', 'update')->name('update');
        Route::delete('destroy/{manufacturerModel}', 'destroy')->name('destroy');
    });
    //Room
    Route::group(['controller' => RoomController::class, 'prefix' => 'room', 'as' => 'room.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{roomModel}', 'edit')->name('edit');
        Route::patch('update/{roomModel}', 'update')->name('update');
        Route::delete('destroy/{roomModel}', 'destroy')->name('destroy');
    });
    //Department
    Route::group(['controller' => DepartmentController::class, 'prefix' => 'department', 'as' => 'department.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{departmentModel}', 'edit')->name('edit');
        Route::patch('update/{departmentModel}', 'update')->name('update');
        Route::delete('destroy/{departmentModel}', 'destroy')->name('destroy');
    });
    //Shift
    Route::group(['controller' => ShiftController::class, 'prefix' => 'shift', 'as' => 'shift.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{shiftModel}', 'edit')->name('edit');
        Route::patch('update/{shiftModel}', 'update')->name('update');
        Route::delete('destroy/{shiftModel}', 'destroy')->name('destroy');
    });
    //Role
    Route::group(['controller' => RoleController::class, 'prefix' => 'role', 'as' => 'role.'], function () {
        Route::get('/', 'index')->name('index');
        Route::post('api','api')->name('api');
        Route::post('store','store')->name('store');
    });
    //Equipment Categories
    Route::group(['controller' => EquipmentCategoryController::class, 'prefix' => 'equipment_category', 'as' => 'equipment_category.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{equipmentCategoryModel}', 'edit')->name('edit');
        Route::get('{equipmentCategoryModel}/medicalEquipments', 'medicalEquipments')->name('medicalEquipments');
        Route::post('{equipmentCategoryModel}/medicalEquipments/api', 'medicalEquipments_api')->name('medicalEquipments_api');
        Route::any('{equipmentCategoryModel}/medicalEquipments/medicalEquipments_edit', 'medicalEquipments_edit')->name('medicalEquipments_edit');
        Route::patch('update/{equipmentCategoryModel}', 'update')->name('update');
        Route::delete('destroy/{equipmentCategoryModel}', 'destroy')->name('destroy');
        Route::post('save_image', 'save_image')->name('save_image');
        Route::get('readFiles/{equipmentCategoryModel}', 'readFiles')->name('readFiles');
        Route::post('delete_image/{equipmentCategoryModel}', 'delete_image')->name('delete_image');
    });
    //Medical Equipments
    Route::group(['controller' => MedicalEquipmentController::class, 'prefix' => 'medical_equipment', 'as' => 'medical_equipment.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{medicalEquipmentModel}', 'edit')->name('edit');
        Route::patch('update/{medicalEquipmentModel}', 'update')->name('update');
        Route::delete('destroy/{medicalEquipmentModel}', 'destroy')->name('destroy');
    });
    //Assignment
    Route::group(['controller' => AssignmentController::class, 'prefix' => 'assignment', 'as' => 'assignment.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('/calender', 'calender')->name('calender');
        Route::post('/render_calender', 'render_calender')->name('render_calender');
        Route::post('/render_calender_detail', 'render_calender_detail')->name('render_calender_detail');
        Route::get('detail', 'detail')->name('detail');
        Route::get('create', 'create')->name('create');
        Route::post('import', 'import')->name('import');
        Route::post('export', 'export')->name('export');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{assignmentModel}', 'edit')->name('edit');
        Route::patch('update/{assignmentModel}', 'update')->name('update');
        Route::delete('destroy/{assignmentModel}', 'destroy')->name('destroy');
    });

    //Phần này của nhân viên soát vé
    Route::group(['controller' => NumberController::class, 'prefix' => 'number', 'as' => 'number.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('/ticket', 'ticket')->name('ticket');
        Route::get('{roomModel}/waiting_patient', 'waiting_patient')->name('waiting_patient');
        Route::get('render_waiting_patient', 'render_waiting_patient')->name('render_waiting_patient');
        Route::get('create_waiting_patient', 'create_waiting_patient')->name('create_waiting_patient');
        Route::get('print_number/{numberModel}', 'print_number')->name('print_number');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{numberModel}', 'edit')->name('edit');
        Route::patch('update/{numberModel}', 'update')->name('update');
        Route::delete('destroy/{medicalEquipmentModel}', 'destroy')->name('destroy');
    });
    //Phần này của bác sĩ
    // Prescription
    Route::group(['controller' => PrescriptionController::class, 'prefix' => 'prescription', 'as' => 'prescription.'],function(){
        Route::get('/{numberModel}/{userModel}/{medical_recordModel}', 'index')->name('index');
        Route::get('/{userModel}/{medical_recordModel}/print_prescription', 'print_prescription')->name('print_prescription');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{prescriptionModel}', 'edit')->name('edit');
        Route::patch('update/{prescriptionModel}', 'update')->name('update');
        Route::delete('destroy/{prescriptionModel}', 'destroy')->name('destroy');
        Route::get('select_medicine', 'select_medicine')->name('select_medicine');
        Route::get('render_medicine', 'render_medicine')->name('render_medicine');
        Route::get('render_note_medicine', 'render_note_medicine')->name('render_note_medicine');
        Route::get('category_select_medicine', 'category_select_medicine')->name('category_select_medicine');
        Route::get('manufacturer_select_medicine', 'manufacturer_select_medicine')->name('manufacturer_select_medicine');
        Route::patch('update_medical_record/{medical_recordModel}', 'update_medical_record')->name('update_medical_record');
        Route::patch('update_re_exam_date/{medical_recordModel}', 'update_re_exam_date')->name('update_re_exam_date');
        //Route::post('/{numberModel}/{userModel}/{medical_recordModel}/update_number_medical_record}', 'update_number_medical_record')->name('update_number_medical_record');
        Route::get('/{numberModel}/{userModel}/{medical_recordModel}/update_number_medical_record', 'update_number_medical_record')->name('update_number_medical_record');

    });
    //
    Route::group(['controller' => PrescriptionDetailController::class, 'prefix' => 'prescription_detail', 'as' => 'prescription_detail.'],function(){
        Route::get('/{userModel}/{prescriptionDetailModel}', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{prescriptionDetailModel}', 'edit')->name('edit');
        Route::patch('update/{prescriptionDetailModel}', 'update')->name('update');
        Route::delete('destroy/{prescriptionDetailModel}', 'destroy')->name('destroy');
    });
    //Medical record
    Route::group(['controller' => MedicalRecordController::class, 'prefix' => 'medical_record', 'as' => 'medical_record.'],function(){
        Route::get('/{numberModel}/{userModel}', 'index')->name('index');
        Route::get('/{numberModel}/{userModel}/create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{medical_recordModel}', 'edit')->name('edit');
        Route::patch('update/{medical_recordModel}', 'update')->name('update');
        Route::patch('update_reason/{medical_recordModel}', 'update_reason')->name('update_reason');
        Route::patch('update_disease/{medical_recordModel}', 'update_disease')->name('update_disease');
        Route::patch('update_note/{medical_recordModel}', 'update_note')->name('update_note');
        Route::patch('update_prescription_detail/{prescriptionDetailModel}', 'update_prescription_detail')->name('update_prescription_detail');
        Route::get('delete_reason/{medical_recordModel}', 'delete_reason')->name('delete_reason');
        Route::get('delete_disease/{medical_recordModel}', 'delete_disease')->name('delete_disease');
        Route::patch('update/{medical_recordModel}', 'update')->name('update');
        Route::delete('destroy/{medical_recordModel}', 'destroy')->name('destroy');
        Route::get('{userModel}/render_service', 'render_service')->name('render_service');
    });
    //Phiếu chỉ định
    Route::group(['controller' => TestRequisitionController::class, 'prefix' => 'test_requisition', 'as' => 'test_requisition.'],function(){
        Route::get('/{userModel}', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{test_requisitionModel}', 'edit')->name('edit');
        Route::patch('update/{test_requisitionModel}', 'update')->name('update');
        Route::delete('destroy/{test_requisitionModel}', 'destroy')->name('destroy');
        Route::get('select_service', 'select_service')->name('select_service');
        Route::get('{userModel}/render_test_requisition', 'render_test_requisition')->name('render_test_requisition');
        Route::get('{userModel}/render_service', 'render_service')->name('render_service');
        Route::get('{userModel}/store_test_requisition', 'store_test_requisition')->name('store_test_requisition');
        Route::get('{userModel}/redirect_print_test_requisition', 'redirect_print_test_requisition')->name('redirect_print_test_requisition');
        Route::get('{userModel}/print_test_requisition', 'print_test_requisition')->name('print_test_requisition');
    });
    //Patient
    Route::group(['controller' => PatientController::class, 'prefix' => 'patient', 'as' => 'patient.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('{numberModel}/list', 'patient_list')->name('patient_list');
        Route::get('/{numberModel}/{userModel}', 'patient_medical_record')->name('patient_medical_record');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{userModel}', 'edit')->name('edit');
        Route::patch('update/{userModel}', 'update')->name('update');
        Route::delete('destroy/{userModel}', 'destroy')->name('destroy');
    });
    //Bill
    Route::group(['controller' => BillController::class, 'prefix' => 'bill', 'as' => 'bill.'],function(){
        Route::get('/', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{billModel}', 'edit')->name('edit');
        Route::patch('update/{billModel}', 'update')->name('update');
        Route::delete('destroy/{billModel}', 'destroy')->name('destroy');
    });
});
