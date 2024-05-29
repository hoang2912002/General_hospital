<?php

namespace App\Policies;

use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\LoginModel;
use Illuminate\Auth\Access\Response;

class BillModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        if(in_array('bill.index',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, BillModel $billModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(LoginModel $loginModel)
    {
        if(in_array('bill.create',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(LoginModel $loginModel, BillModel $billModel)
    {
        if(in_array('bill.update',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, BillModel $billModel)
    {
        if(in_array('bill.destroy',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, BillModel $billModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, BillModel $billModel)
    {
        //
    }
}
