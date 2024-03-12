<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUserModel extends Model
{
    use HasFactory;
    protected $table = 'group_users';
    protected $fillable = [
        'user_uuid','group_id'
    ];
    public function groups(){
        return $this->hasOne(GroupModel::class,'id','group_id');
    }
    public function users(){
        return $this->hasOne(UserModel::class,'uuid','user_uuid');
    }
}
