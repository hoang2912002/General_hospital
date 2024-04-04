<?php

namespace App\Policies;

use App\Models\ManagementModel\EquipmentCategoryModel;
use App\Models\ManagementModel\LoginModel;
use Illuminate\Auth\Access\Response;

class EquipmentCategoryModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        if(in_array('equipment_category.index',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, EquipmentCategoryModel $equipmentCategoryModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(LoginModel $loginModel)
    {
        if(in_array('equipment_category.create',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(LoginModel $loginModel, EquipmentCategoryModel $equipmentCategoryModel)
    {
        if(in_array('equipment_category.update',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, EquipmentCategoryModel $equipmentCategoryModel)
    {
        if(in_array('equipment_category.destroy',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, EquipmentCategoryModel $equipmentCategoryModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, EquipmentCategoryModel $equipmentCategoryModel)
    {
        //
    }
}
