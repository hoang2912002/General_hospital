<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftModel extends Model
{
    use HasFactory;
    protected $table = 'shifts';
    protected $fillable = [
        'name','slug'
    ];
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function shift(){
        switch ($this->id) {
            case 1:
                return '7 giờ 30 phút';
                break;
            case 2:
                return '8 giờ 00';
                break;
            case 3:
                return '8 giờ 30 phút';
                break;
            case 4:
                return '9 giờ 00';
                break;
            case 5:
                return '9 giờ 30 phút';
                break;
            case 6:
                return '10 giờ 00';
                break;
            case 7:
                return '10 giờ 30 phút';
                break;
                
            default:
                return '11 giờ 00';
                break;
        }
    }
}
