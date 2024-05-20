<?php

namespace App\Policies;

use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\NumberModel;
use Illuminate\Auth\Access\Response;

class NumberModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        if(in_array('number.index',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, NumberModel $numberModel)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(LoginModel $loginModel)
    {
        if(in_array('number.create_waiting_patient',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(LoginModel $loginModel, NumberModel $numberModel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, NumberModel $numberModel)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, NumberModel $numberModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, NumberModel $numberModel)
    {
        //
    }
}
