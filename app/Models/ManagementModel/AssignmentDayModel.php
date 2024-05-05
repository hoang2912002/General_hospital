<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentDayModel extends Model
{
    use HasFactory;
    protected $table = 'assignment_days';
    protected $fillable = ['assignment_id','day_id'];
    public function assignment(){
        return $this->hasOne(AssignmentModel::class,'id','assignment_id');
    }
    public function assignment_room(){
        return $this->hasMany(AssignmentRoomModel::class,'assignment_day_id','id');
    }
    public function day_check($day){
        switch ($day) {
            case 'thu_2':
                return 1;
                break;
            case 'thu_3':
                return 2;
                break;
            case 'thu_4':
                return 3;
                break;
            case 'thu_5':
                return 4;
                break;
            case 'thu_6':
                return 5;
                break;
            case 'thu_7':
                return 6;
                break;
            case 'chu_nhat':
                return 0;
                break;
            default:
                return 0;
                break;
        }
    }

    public function day($day){
        //dd($day);
        switch ($day) {
            case 1:
                return 'Thứ 2';
                break;
            case 2:
                return 'Thứ 3';
                break;
            case 3:
                return 'Thứ 4';
                break;
            case 4:
                return 'Thứ 5';
                break;
            case 5:
                return 'Thứ 6';
                break;
            case 6:
                return 'Thứ 7';
                break;
            default:
                return 'Chủ nhật';
                break;
        }
    }
}
