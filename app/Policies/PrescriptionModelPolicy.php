<?php

namespace App\Policies;

use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\PrescriptionModel;
use Illuminate\Auth\Access\Response;

class PrescriptionModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        if(in_array('prescription.index',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, PrescriptionModel $prescriptionModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(LoginModel $loginModel)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(LoginModel $loginModel, PrescriptionModel $prescriptionModel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, PrescriptionModel $prescriptionModel)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, PrescriptionModel $prescriptionModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, PrescriptionModel $prescriptionModel)
    {
        //
    }
}
