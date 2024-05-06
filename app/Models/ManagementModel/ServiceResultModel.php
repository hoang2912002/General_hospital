<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceResultModel extends Model
{
    use HasFactory;
    protected $table = 'services_result';
    protected $fillable = [
        'medical_record_id','shift_id','day_id','service_id','price','result_file_path','result_file_name','note'
    ];

    public function medical_record(){
        return $this->hasOne(MedicalRecordModel::class,'id','medical_record_id');
    }
    public function shift(){
        return $this->hasOne(ShiftModel::class,'id','shift_id');
    }
    public function service(){
        return $this->hasOne(ServiceModel::class,'id','service_id');
    }
}
