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


    public function hour(){
        switch ($this->id) {
            case 1:
                return '00:00:00 đến 02:00:00';
                break;
            case 2:
               return '02:00:00 đến 04:00:00';
                break;
            case 3:
                return '04:00:00 đến 06:00:00';
                break;
            case 4:
                return '06:00:00 đến 08:00:00';
                break;
            case 5:
               return '08:00:00 đến 10:00:00';
                break;
            case 6:
                return '10:00:00 đến 12:00:00';
                break;
            case 7:
                return '12:00:00 đến 14:00:00';
                break;
            case 8:
                return '14:00:00 đến 16:00:00';
                break;
            case 9:
                return '16:00:00 đến 18:00:00';
                break;
            case 10:
                return '18:00:00 đến 20:00:00';
                break;
            case 11:
                return '20:00:00 đến 22:00:00';
                break;
            case 12:
                return '22:00:00 đến 00:00:00';
                break;

            default:
                return '06:00:00 đến 08:00:00';
                break;
        }
    }
    public function hour_flw_slug(){
        switch ($this->slug) {
            case 'ca-1':
                return '00:00:00 đến 02:00:00';
                break;
            case 'ca-2':
               return '02:00:00 đến 04:00:00';
                break;
            case 'ca-3':
                return '04:00:00 đến 06:00:00';
                break;
            case 'ca-4':
                return '06:00:00 đến 08:00:00';
                break;
            case 'ca-5':
               return '08:00:00 đến 10:00:00';
                break;
            case 'ca-6':
                return '10:00:00 đến 12:00:00';
                break;
            case 'ca-7':
                return '12:00:00 đến 14:00:00';
                break;
            case 'ca-8':
                return '14:00:00 đến 16:00:00';
                break;
            case 'ca-9':
                return '16:00:00 đến 18:00:00';
                break;
            case 'ca-10':
                return '18:00:00 đến 20:00:00';
                break;
            case 'ca-11':
                return '20:00:00 đến 22:00:00';
                break;
            case 'ca-12':
                return '22:00:00 đến 00:00:00';
                break;

            default:
                return '06:00:00 đến 08:00:00';
                break;
        }
    }
}
