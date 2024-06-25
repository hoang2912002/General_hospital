<?php

namespace App\Http\Controllers\ManagementController;
use App\Http\Controllers\Controller;
use App\Models\ManagementModel\AppointmentModel;
use App\Models\ManagementModel\NumberModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Milon\Barcode\DNS2D;
use Milon\Barcode\Facades\DNS2DFacade;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MailController extends Controller
{
    // public function send_mail(Request $request){
    //     $appointment = AppointmentModel::where('id',$request->appointment_id)->first();
    //     $number = NumberModel::where('id',$request->number_id)->first();
    //     if(!empty($appointment)){


    //         //send mail
    //         $to_name = "Đa khoa G37";
    //         $to_email = $appointment->email;//send to this email
    //         $to_content = $number;
    //         $qr_code =  base64_encode(QrCode::format('png')->size(200)->generate($number->patient_identification_code));
    //         //$qrCode =QrCode::format('png')->size(200)->encoding('UTF-8')->generate($number->patient_identification_code);
    //         $data = array(
    //             "name"=>"Gửi qr code đặt lịch hẹn Đa khoa G37",
    //             "body"=>'Gửi phiếu đặt lịch hẹn khám bệnh',
    //             "number" => $to_content,
    //             "qr_code" => base64_encode(QrCode::format('png')->size(200)->generate($number->patient_identification_code)),
    //         ); //body of mail.blade.php



    //         Mail::send('management.appointment.send_mail_qr_code',$data,function($message) use ($to_email,$to_name,$qr_code){
    //             $message->to($to_email)->subject('Gửi phiếu đặt lịch hẹn khám bệnh');//send this mail with subject
    //             $message->from($to_email,$to_name);//send from this mail
    //         });
    //         //--send mail
    //         //return redirect()->route('management.appointment.send_mail_qr_code');
    //         $Route = route('appointment.index');
    //         return response()->json(['success' => true,'Route' => $Route]);
    //     }
    //     else{
    //         return response()->json(['success' => false]);
    //     }

    // }
    public function send_mail(Request $request)
    {
        $appointment = AppointmentModel::where('id', $request->appointment_id)->first();
        $number = NumberModel::where('id', $request->number_id)->first();
        if (!empty($appointment) && !empty($number)) {
            // Generate QR code and save it to public directory
            $qrCode = QrCode::format('png')->size(300)->generate($number->patient_identification_code);
            $qrCodePath = public_path('qr_codes/' . $number->patient_identification_code . '.png');
            file_put_contents($qrCodePath, $qrCode);

            // Send email
            $to_name = "Đa khoa G37";
            $to_email = $appointment->email;
            $data = [
                "name" => "Gửi qr code đặt lịch hẹn Đa khoa G37",
                "body" => 'Gửi phiếu đặt lịch hẹn khám bệnh',
                "number" => $number,
                "date" =>  $appointment->medical_examination_day(),
                "qr_code_path" => $qrCodePath
            ];

            Mail::send('management.appointment.send_mail_qr_code', $data, function ($message) use ($to_email, $to_name, $qrCodePath) {
                $message->to($to_email)->subject('Gửi phiếu đặt lịch hẹn khám bệnh');
                $message->from($to_email, $to_name);
                $message->attach($qrCodePath, [
                    'as' => 'QrCode.png',
                    'mime' => 'image/png',
                ]);
            });

            // Remove the QR code file after sending email (optional)
            unlink($qrCodePath);

            // Return response
            $Route = route('appointment.index');
            return response()->json(['success' => true, 'Route' => $Route]);
        } else {
            return response()->json(['success' => false]);
        }
    }
}
