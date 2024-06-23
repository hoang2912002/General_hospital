<?php

namespace App\Models\ManagementModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentModel extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $fillable = [
        'user_uuid',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'email',
        'phone_number',
        'patient_identification_code',
        'doctor_uuid',
        'status',
        'note',
        'date',
        'shift_id'
    ];
    public function user(){
        return $this->hasOne(UserModel::class, 'uuid', 'user_uuid');
    }
    public function doctor(){
        return $this->hasOne(UserModel::class, 'uuid', 'doctor_uuid');
    }
    public function shift(){
        return $this->hasOne(ShiftModel::class, 'id', 'shift_id');
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
    public function booker_full_name(){
        return $this->last_name . ' ' . $this->first_name;
    }

    public function status_name(){
        switch ($this->status) {
            case 1:
                return '<span class="badge bg-gradient-primary">Đã đặt</span>';
                break;
            case 2:
                return '<span class="badge bg-gradient-info">Đã duyệt</span>';
                break;
            case 3:
                return '<span class="badge bg-gradient-success">Đã khám</span>Đã khám';
                break;
            default:
                return '<span class="badge bg-gradient-primary">Đã đặt</span>';
                break;
        }
    }
    public function gender(){
        return ($this->gender === 1) ? 'Nam' : 'Nữ';
    }
    public function date($date){
        return date('d-m-Y', strtotime($date));
    }

    public function medical_examination_day(){
        return 'Ngày khám ' . $this->date($this->date) . ' Giờ khám ' . $this->shift->hour_flw_slug();
    }
}
