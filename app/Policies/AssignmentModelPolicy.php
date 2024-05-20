<?php

namespace App\Policies;

use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\LoginModel;
use Illuminate\Auth\Access\Response;

class AssignmentModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(LoginModel $loginModel)
    {
        if(in_array('assignment.index',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(LoginModel $loginModel, AssignmentModel $assignmentModel)
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
    public function update(LoginModel $loginModel, AssignmentModel $assignmentModel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(LoginModel $loginModel, AssignmentModel $assignmentModel)
    {
        if(in_array('assignment.destroy',$loginModel->User->getPermision())){
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(LoginModel $loginModel, AssignmentModel $assignmentModel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(LoginModel $loginModel, AssignmentModel $assignmentModel)
    {
        //
    }
}
