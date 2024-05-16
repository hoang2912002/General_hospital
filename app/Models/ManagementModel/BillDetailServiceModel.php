<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetailServiceModel extends Model
{
    use HasFactory;
    protected $table = 'bill_details_service';
    protected $fillable = [
        'bill_id','service_result_id','price'
    ];

    public function bill(){
        return $this->hasOne(BillModel::class,'id','bill_id');
    }
    public function service_result(){
        return $this->hasMany(ServiceResultModel::class,'id','service_result_id');
    }

    public function service_result_detail(){
        return $this->hasOne(ServiceResultModel::class,'id','service_result_id');
    }
}
