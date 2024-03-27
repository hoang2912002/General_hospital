<?php

namespace App\Policies;

use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\ShiftModel;
use Illuminate\Auth\Access\Response;

class ShiftModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        if(in_array('shift.index',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, ShiftModel $shiftModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(LoginModel $loginModel)
    {
        if(in_array('shift.create',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(LoginModel $loginModel, ShiftModel $shiftModel)
    {
        if(in_array('shift.update',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, ShiftModel $shiftModel)
    {
        if(in_array('shift.destroy',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, ShiftModel $shiftModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, ShiftModel $shiftModel)
    {
        //
    }
}
