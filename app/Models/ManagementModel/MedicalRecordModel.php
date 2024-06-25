<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecordModel extends Model
{
    use HasFactory;
    protected $table = "medical_records";
    protected $fillable = [
        'user_uuid','reason','weight','height','vessel','blood_pressure','temperature','note','disease','doctor_uuid','re_exam_date','exam_date','shift_id','appointment_id'
    ];
    public function user_uuid() {
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }
    public function user() {
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }

    public function doctor(){
        return $this->hasOne(UserModel::class,'uuid','doctor_uuid');
    }

    public function re_exam_date() {
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }
    public function number_medical_record(){
        return $this->hasOne(Number_medicalRecordModel::class,'medical_record_id','id');
    }
    public function appointment(){
        return ($this->appointment_id == NULL) ? 'Không' : 'Có';
    }
    public function service_result(){
        return $this->hasMany(ServiceResultModel::class,'medical_record_id','id');
    }
    public function prescription(){
        return $this->hasOne(PrescriptionModel::class,'medical_record_id','id');
    }
    public function shift_relation(){
        return $this->hasOne(ShiftModel::class,'id','shift_id');
    }

    public function shift(){
        switch ($this->shift_id) {
            case 1:
                return '00:00:00 đến 02:00:00';
                break;
            case 2:
               return '02:00:00 đến 04:00:00';
                break;
            case 3:
                return '04:00:00 đến 06:00:00';
                break;
            case 4:
                return '06:00:00 đến 08:00:00';
                break;
            case 5:
               return '08:00:00 đến 10:00:00';
                break;
            case 6:
                return '10:00:00 đến 12:00:00';
                break;
            case 7:
                return '12:00:00 đến 14:00:00';
                break;
            case 8:
                return '14:00:00 đến 16:00:00';
                break;
            case 9:
                return '16:00:00 đến 18:00:00';
                break;
            case 10:
                return '18:00:00 đến 20:00:00';
                break;
            case 11:
                return '20:00:00 đến 22:00:00';
                break;
            case 12:
                return '22:00:00 đến 00:00:00';
                break;

            default:
                return '06:00:00 đến 08:00:00';
                break;
        }
    }

    public function date($date)
    {
        return  date('d/m/Y', strtotime($date));

    }
    public function current_date(){
        return date('d/m/Y');
    }
}
