<?php

namespace App\Models\ManagementModel;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberModel extends Model
{
    use HasFactory;
    protected $table = "numbers";
    protected $fillable = [
        'number','room_id', 'status'
    ];

    public function room(){
        return $this->hasOne(RoomModel::class,'id','room_id');
    }
    public function number_medical_record(){
        return $this->hasOne(Number_medicalRecordModel::class,'number_id','id');
    }
    public function date_time(){

        $created_at = Carbon::parse($this->created_at)->timezone('Asia/Ho_Chi_Minh');

        // Định dạng lại thời gian theo định dạng mong muốn
        $hour = $created_at->format('g:i A');
        $date = $created_at->format('d/m/Y');

        return 'Ngày khám ' . $date . ' Giờ ' . $hour;
    }

    public function status() {
        switch ($this->status) {
            case 1:
                return '<span class="badge bg-gradient-info">Đang chờ</span>';
                break;
            case 2:
                return '<span class="badge bg-gradient-primary">Đang khám</span>';
                break;
            case 3:
                return '<span class="badge bg-gradient-warning">Đã khám</span>';
                break;
            default:
                return '<span class="badge bg-gradient-info">Đang chờ</span>';
                break;
        }
    }
}
