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

    public function shift(){
        switch ($this->shift_id) {
            case 1:
                return '7 giờ 30 phút';
                break;
            case 2:
                return '8 giờ 00';
                break;
            case 3:
                return '8 giờ 30 phút';
                break;
            case 4:
                return '9 giờ 00';
                break;
            case 5:
                return '9 giờ 30 phút';
                break;
            case 6:
                return '10 giờ 00';
                break;
            case 7:
                return '10 giờ 30 phút';
                break;

            default:
                return '11 giờ 00';
                break;
        }
    }
}
