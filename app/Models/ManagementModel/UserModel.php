<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;
    protected $primaryKey = 'uuid';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $table = 'users';
    protected $fillable = [
        'uuid', 'first_name', 'last_name', 'gender', 'dob', 'login_id'
    ];
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    public function login()
    {
        return $this->hasOne(LoginModel::class,'id','login_id');
    }
    public function doctor()
    {
        return $this->hasOne(DoctorModel::class,'doctor_uuid','uuid');
    }

    public function group_user(){
        return $this->belongsToMany(GroupModel::class,'group_users','user_uuid','group_id','uuid','id')->withPivot('group_id');
    }
    public function gr_user(){
        return $this->hasOne(GroupUserModel::class,'user_uuid','uuid');
    }
    public function dob(){
        return date('d-m-Y', strtotime($this->dob));
    }
    public function birthdate()
    {
        return  date('d/m/Y', strtotime($this->dob));

    }
    public function gender(){
        switch ($this->gender) {
            case '0':
                return '<span class="badge badge-sm bg-gradient-info">Female</span>';
                break;
            case '1':
                return '<span class="badge badge-sm bg-gradient-primary">Male</span>';
                break;
            default:
                break;
        }
    }
}
