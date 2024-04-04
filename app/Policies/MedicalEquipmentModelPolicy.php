<?php

namespace App\Policies;

use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\MedicalEquipmentModel;
use Illuminate\Auth\Access\Response;

class MedicalEquipmentModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        if(in_array('medical_equipment.index',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(LoginModel $loginModel)
    {
        if(in_array('medical_equipment.create',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(LoginModel $loginModel, MedicalEquipmentModel $medicalEquipmentModel)
    {
        if(in_array('medical_equipment.update',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, MedicalEquipmentModel $medicalEquipmentModel)
    {
        if(in_array('medical_equipment.destroy',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, MedicalEquipmentModel $medicalEquipmentModel)
    {
        //
    }
}
