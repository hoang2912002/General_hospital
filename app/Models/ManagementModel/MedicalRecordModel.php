<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordModel extends Model
{
    use HasFactory;
    protected $table = "medical_records";
    protected $fillable = [
        'user_uuid','reason','weight','height','vessel','blood_pressure','temperature','note','disease','doctor_uuid','re-exam_date','day_id','shift_id','appointment_id'
    ];
    public function user_uuid() {
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }

    public function re_exam_date() {
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }

    public function appointment(){
        return ($this->appointment_id == NULL) ? 'Không' : 'Có';
    }
}
