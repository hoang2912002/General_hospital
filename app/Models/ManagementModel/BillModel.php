<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillModel extends Model
{
    use HasFactory;
    protected $table = "bills";
    protected $fillable = [
        'user_uuid','name','phone_number','total_price','payment_id','transaction_id','status'
    ];

    public function user(){
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }

    public function payment(){
        return $this->hasOne(PaymentModel::class,'id','payment_id');
    }
}
