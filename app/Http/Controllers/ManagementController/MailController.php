<?php

namespace App\Http\Controllers\ManagementController;
use DNS2D;
use App\Http\Controllers\Controller;
use App\Models\ManagementModel\AppointmentModel;
use App\Models\ManagementModel\NumberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MailController extends Controller
{
    public function send_mail(Request $request){
        $appointment = AppointmentModel::where('id',$request->appointment_id)->first();
        $number = NumberModel::where('id',$request->number_id)->first();
        if(!empty($appointment)){


            //send mail
            $to_name = "Đa khoa G37";
            $to_email = $appointment->email;//send to this email
            $to_content = $number;
            //$qrCode = DNS2D::getBarcodeHTML("4445645656", "QRCODE");
            $qrCode =QrCode::format('png')->size(200)->encoding('UTF-8')->generate($number->patient_identification_code);
            $data = array(
                "name"=>"Gửi qr code đặt lịch hẹn Đa khoa G37",
                "body"=>'Gửi phiếu đặt lịch hẹn khám bệnh',
                "number" => $to_content,
                "qr_code" => $qrCode,
            ); //body of mail.blade.php



            Mail::send('management.appointment.send_mail_qr_code',$data,function($message) use ($to_email,$to_name,$number){
                $message->to($to_email)->subject('Gửi phiếu đặt lịch hẹn khám bệnh');//send this mail with subject
                $message->from($to_email,$to_name);//send from this mail

            });
            //--send mail
            //return redirect()->route('management.appointment.send_mail_qr_code');
            $Route = route('appointment.index');
            return response()->json(['success' => true,'Route' => $Route]);
        }
        else{
            return response()->json(['success' => false]);
        }

    }
}
