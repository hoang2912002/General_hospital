<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeModel extends Model
{
    use HasFactory;
    protected $table = 'qr_codes';
    protected $fillable = [
        'code','expires_at'
    ];
}
