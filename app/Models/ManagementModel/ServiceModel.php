<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    use HasFactory;
    protected $table = 'services';
    protected $fillable = [
        'name','slug','thumbnail','price'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }
    public function user_service(){
        return $this->belongsToMany(UserModel::class,'user_service','service_id','user_uuid','id','uuid')->withPivot('uuid');
    }
    public function user_services(){
        return $this->hasMany(UserServiceModel::class,'service_id','id');
    }
    public function price()
    {
        $price = number_format($this->price,'0',".",".") . ' VNĐ';
        return '<span class="text-danger font-size-15 font-weight-bold">' . $price . '</span>';
    }
}
