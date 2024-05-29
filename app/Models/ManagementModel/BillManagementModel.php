<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillManagementModel extends Model
{
    use HasFactory;
    protected $table = "bills";
    protected $fillable = [
        'user_uuid','medical_record_id','name','phone_number','total_price','payment_id','transaction_id','status'
    ];

    public function user(){
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }
    public function medical_record(){
        return $this->hasOne(MedicalRecordModel::class,'id','medical_record_id');
    }

    public function payment(){
        return $this->hasOne(PaymentModel::class,'id','payment_id');
    }

    public function bill_service_result(){
        return $this->hasMany(BillDetailServiceModel::class,'bill_id','id');
    }
    public function bill_prescription(){
        return $this->hasOne(BillDetailPrescriptionModel::class,'bill_id','id');
    }

    public function total_price()
    {
        $total_price = number_format($this->total_price,'0',".",".") . ' VNĐ';
        return  $total_price;
    }

    public function status(){
        return ($this->status == 0) ? '<span class="text-danger">Chưa thanh toán</span>' : '<span class="text-success">Đã thanh toán</span>';
    }
}
