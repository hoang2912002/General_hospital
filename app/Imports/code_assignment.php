<?php

namespace App\Imports;

use App\Models\ManagementModel\AssignmentDayModel;
use App\Models\ManagementModel\AssignmentModel;
use App\Models\ManagementModel\AssignmentRoomModel;
use App\Models\ManagementModel\AssignmentShiftModel;
use App\Models\ManagementModel\RoomModel;
use App\Models\ManagementModel\ShiftModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class ExcelImportAssignments implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $previousRow = [];
    private $data = [];
    public function model(array $row)
    {

        //dd($row);
        //dd($newArray['thu_2'],$row);

        //print_r($previousRowData);
        $previousRowData = $this->previousRow;

        //if(empty($previousRowData)){
            $uuid = $row['uuid'] ?? null;
            if(!in_array($uuid, $this->previousRow) && !empty($uuid)){
                $this->data[] = $uuid;
                $this->previousRow =[
                    'staff_uuid'=>$row['uuid'],
                    'date_start'=>$row['ngay_bat_dau'] ?? $previousRowData['date_start'],
                    'date_end'=>$row['ngay_ket_thuc'] ?? $previousRowData['date_end'],
                ];

            }

        //}
        //dd($row);

        if((strtotime($row['ngay_bat_dau'] ?? $previousRowData['date_start']) !== false ) && (strtotime($row['ngay_ket_thuc'] ?? $previousRowData['date_end']) !== false ) ){
            //dd($row['ngay_bat_dau']);
            $format_date_start = date('d-m-Y', strtotime($row['ngay_bat_dau'] ?? $previousRowData['date_start'] ));
            $format_date_end = date('d-m-Y', strtotime($row['ngay_ket_thuc'] ?? $previousRowData['date_end'] ));
            //dd($format_date_end,$format_date_start,$row['ngay_bat_dau']);
            $date_start = date('Y-m-d', strtotime($format_date_start ));
            $date_end = date('Y-m-d', strtotime($format_date_end ));
        }
        else{
            $date_startValue = $row['ngay_bat_dau'] ?? $previousRowData['date_start'];
            $date_endValue = $row['ngay_ket_thuc'] ?? $previousRowData['date_end'];
            if(is_numeric($date_startValue)){
                $excel_startDate = is_numeric($date_startValue) ? $date_startValue : Date::excelToTimestamp($date_startValue);
                $date_startTimeObject = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excel_startDate);
                $date_start = $date_startTimeObject->format('Y-m-d');
            }
            else{
                $format_date_start = date('d-m-Y', strtotime($row['ngay_bat_dau'] ?? $previousRowData['date_start'] ));
                $date_start = date('Y-m-d', strtotime($format_date_start ));
            }
            if(is_numeric($date_endValue)){
                //dd('else',strtotime($row['ngay_bat_dau'] ?? $previousRowData['date_start']) !== false,$row['ngay_bat_dau'] ?? $previousRowData['date_start'],$row['ngay_ket_thuc'] ?? $previousRowData['date_end']);
                $excel_endDate = is_numeric($date_endValue) ? $date_endValue : Date::excelToTimestamp($date_endValue);
                $date_endTimeObject = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($excel_endDate);
                $date_end = $date_endTimeObject->format('Y-m-d');
            }
            else{
                $format_date_end = date('d-m-Y', strtotime($row['ngay_ket_thuc'] ?? $previousRowData['date_end'] ));
                $date_end = date('Y-m-d', strtotime($format_date_end ));
            }
        }


        $uuid = $row['uuid'] ?? $previousRowData['staff_uuid'];
        $assignment_id = AssignmentModel::where([
            ['staff_uuid', $uuid ],
            ['date_start',$date_start],
            ['date_end',$date_end],
        ])->value('id');
        //dd($assignment_id);
        if(empty($assignment_id)){
            //dd($row['uuid']);
            $assignment = AssignmentModel::create([
                'staff_uuid' => $row['uuid'] ?? $previousRowData['staff_uuid'],
                'date_start' => $date_start,
                'date_end' => $date_end,
            ]);
            $assignment_id = $assignment->id;
        }

        $assignmentDayModel  = new AssignmentDayModel();
        foreach ($row as $key => $value) {
            if (strpos($key, 'thu_') === 0) {
                $day = $assignmentDayModel->day_check($key);
                $assignment_day_id = $assignmentDayModel->where([
                    ['assignment_id',$assignment_id],
                    ['day_id',$day],
                ])->value('id');
                if(empty($assignment_day_id)){
                    $assignment_day = $assignmentDayModel::create([
                        'assignment_id' => $assignment_id,
                        'day_id' => $day,
                    ]);
                    $assignment_day_id = $assignment_day->id;
                }
                $shift_id  =  ShiftModel::where('slug',Str::slug($value))->value('id');
                $assignment_shift_id = AssignmentShiftModel::where([
                    ['assignment_id',$assignment_id],
                    ['shift_id',$shift_id],
                ])->value('id');
                if(!empty($shift_id) && empty($assignment_shift_id)){
                    $assignment_shift = AssignmentShiftModel::create([
                        'assignment_id' => $assignment_id,
                        'shift_id' => $shift_id,
                    ]);
                    $assignment_shift_id = $assignment_shift->id;
                }
            }
            if (is_numeric($key)) {
                //if(!empty($assignment_shift) && !empty($assignment_day)){
                    $room = RoomModel::where('slug',Str::slug($value))->value('id');
                    $check_assignment_room = AssignmentRoomModel::where([
                        ['assignment_day_id',$assignment_day_id],
                        ['assignment_shift_id',$assignment_shift_id],
                        'room_id' => $room,
                    ])->value('id');
                    if(!empty($room) && empty($check_assignment_room)){
                       $assignment_room = AssignmentRoomModel::create([
                            'assignment_day_id' => $assignment_day_id,
                            'assignment_shift_id' => $assignment_shift_id,
                            'room_id' => $room,
                        ]);
                    }

                //}
            }
        }
    }

    public function headingRow(): int
    {
        return 1;
    }

}
