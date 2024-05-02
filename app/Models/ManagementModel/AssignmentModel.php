<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentModel extends Model
{
    use HasFactory;
    protected $table = 'assignments';
    protected $fillable = ['staff_uuid','date_start','date_end'];
    public function staff(){
        return $this->hasOne(UserModel::class,'uuid','staff_uuid');
    }
    public function assignment_shift(){
        return $this->hasMany(AssignmentShiftModel::class,'assignment_id','id');
    }
    public function assignment_day(){
        return $this->hasMany(AssignmentDayModel::class,'assignment_id','id');
    }
    public function date($date)
    {
        return date('d/m/Y', strtotime($date));
    }
}
