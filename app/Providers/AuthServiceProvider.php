<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\ManagementController\MedicalRecordManagementController;
use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\CategoryModel;
use App\Models\ManagementModel\DepartmentModel;
use App\Models\ManagementModel\EquipmentCategoryModel;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicalEquipmentModel;
use App\Models\ManagementModel\MedicalRecordModel;
use App\Models\ManagementModel\MedicineModel;
use App\Models\ManagementModel\NumberModel;
use App\Models\ManagementModel\PatientModel;
use App\Models\ManagementModel\PrescriptionModel;
use App\Models\ManagementModel\RoleModel;
use App\Models\ManagementModel\RoomModel;
use App\Models\ManagementModel\ServiceModel;
use App\Models\ManagementModel\ServiceResultModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\TestRequisitionModel;
use App\Models\ManagementModel\UserModel;
use App\Policies\AssignmentModelPolicy;
use App\Policies\BillModelPolicy;
use App\Policies\CategoryModelPolicy;
use App\Policies\DepartmentModelPolicy;
use App\Policies\EquipmentCategoryModelPolicy;
use App\Policies\EquipmentCatogoryModelPolicy;
use App\Policies\GroupModelPolicy;
use App\Policies\ManufacturerModelPolicy;
use App\Policies\MedicalEquipmentModelPolicy;
use App\Policies\MedicalRecordManagementModelPolicy;
use App\Policies\MedicalRecordModelPolicy;
use App\Policies\MedicineModelPolicy;
use App\Policies\NumberModelPolicy;
use App\Policies\PatientModelPolicy;
use App\Policies\PrescriptionModelPolicy;
use App\Policies\RoleModelPolicy;
use App\Policies\RoomModelPolicy;
use App\Policies\ServiceModelPolicy;
use App\Policies\ServiceResultManagementModelPolicy;
use App\Policies\ServiceResultModelPolicy;
use App\Policies\ShiftModelPolicy;
use App\Policies\TestRequisitionModelPolicy;
use App\Policies\UserModelPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        AssignmentModel::class =>AssignmentModelPolicy::class,
        BillModel::class =>BillModelPolicy::class,
        MedicalRecordModel::class =>MedicalRecordModelPolicy::class,
        MedicalRecordModel::class =>MedicalRecordManagementModelPolicy::class,
        NumberModel::class =>NumberModelPolicy::class,
        PatientModel::class =>PatientModelPolicy::class,
        PrescriptionModel::class =>PrescriptionModelPolicy::class,
        ServiceResultModel::class =>ServiceResultManagementModelPolicy::class,
        ServiceResultModel::class =>ServiceResultModelPolicy::class,
        TestRequisitionModel::class =>TestRequisitionModelPolicy::class,
        GroupModel::class =>GroupModelPolicy::class,
        CategoryModel::class =>CategoryModelPolicy::class,
        ManufacturerModel::class =>ManufacturerModelPolicy::class,
        MedicineModel::class =>MedicineModelPolicy::class,
        RoleModel::class =>RoleModelPolicy::class,
        RoomModel::class =>RoomModelPolicy::class,
        ServiceModel::class =>ServiceModelPolicy::class,
        ShiftModel::class =>ShiftModelPolicy::class,
        UserModel::class =>UserModelPolicy::class,
        DepartmentModel::class =>DepartmentModelPolicy::class,
        EquipmentCategoryModel::class =>EquipmentCategoryModelPolicy::class,
        MedicalEquipmentModel::class =>MedicalEquipmentModelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
