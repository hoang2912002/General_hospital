<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class LoginModel extends User
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
