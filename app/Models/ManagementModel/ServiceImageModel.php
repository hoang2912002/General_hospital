<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceImageModel extends Model
{
    use HasFactory;
    protected $table = 'service_images';
    protected $fillable = [
        'service_id','image'
    ];
}
