<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\ManagementModel\CategoryModel;
use App\Models\ManagementModel\GroupModel;
use App\Models\ManagementModel\ManufacturerModel;
use App\Models\ManagementModel\MedicineModel;
use App\Models\ManagementModel\RoleModel;
use App\Models\ManagementModel\RoomModel;
use App\Models\ManagementModel\ServiceModel;
use App\Models\ManagementModel\ShiftModel;
use App\Models\ManagementModel\UserModel;
use App\Policies\CategoryModelPolicy;
use App\Policies\GroupModelPolicy;
use App\Policies\ManufacturerModelPolicy;
use App\Policies\MedicineModelPolicy;
use App\Policies\RoleModelPolicy;
use App\Policies\RoomModelPolicy;
use App\Policies\ServiceModelPolicy;
use App\Policies\ShiftModelPolicy;
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
        GroupModel::class =>GroupModelPolicy::class,
        CategoryModel::class =>CategoryModelPolicy::class,
        ManufacturerModel::class =>ManufacturerModelPolicy::class,
        MedicineModel::class =>MedicineModelPolicy::class,
        RoleModel::class =>RoleModelPolicy::class,
        RoomModel::class =>RoomModelPolicy::class,
        ServiceModel::class =>ServiceModelPolicy::class,
        ShiftModel::class =>ShiftModelPolicy::class,
        UserModel::class =>UserModelPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
