<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserServiceModel extends Model
{
    use HasFactory;
    protected $table = 'user_services';
    protected $fillable = [
        'user_uuid','service_id','room_id','price'
    ];
    public function user(){
        return $this->hasMany(UserModel::class,'uuid','user_uuid');
    }
    public function service(){
        return $this->hasMany(ServiceModel::class,'id','service_id');
    }
    public function room(){
        return $this->hasMany(RoomModel::class,'id','room_id');
    }
}
