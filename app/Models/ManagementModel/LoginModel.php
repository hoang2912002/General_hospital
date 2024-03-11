<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    use HasFactory;
    protected $table = 'logins';
    protected $fillable = [
        'email','phone_number','password', 'remember_token', 'activated'
    ];

    public function User()
    {
        return $this->hasOne(UserModel::class,'login_id','id');
    }

}
