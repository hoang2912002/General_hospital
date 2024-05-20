<?php

namespace App\Policies;

use App\Models\ManagementModel\LoginModel;
use App\Models\ManagementModel\TestRequisitionModel;
use Illuminate\Auth\Access\Response;

class TestRequisitionModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, TestRequisitionModel $testRequisitionModel)
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
    public function update(LoginModel $loginModel, TestRequisitionModel $testRequisitionModel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, TestRequisitionModel $testRequisitionModel)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, TestRequisitionModel $testRequisitionModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, TestRequisitionModel $testRequisitionModel)
    {
        //
    }
}
