<?php

namespace App\Http\Controllers\ManagementController;

use App\Http\Controllers\Controller;
use App\Models\ManagementModel\BillModel;
use App\Models\ManagementModel\PaymentModel;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PayMentController extends Controller
{
    public function paypal(Request $request)
    {
        $total_price = explode('VNĐ', $request->total_price);
        $total_price = explode('.', $total_price[0]);
        $total_price = implode('', $total_price);

        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('payment.paypal_success', ['billModel' => $request->bill_id]),
                "cancel_url" => route('payment.paypal_cancel', ['billModel' => $request->bill_id]),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => round($total_price / floatval(24350.00), 2)
                    ]
                ]
            ]
        ]);
        //dd($response);
        if (isset($response['id']) && $response['id'] !== null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('payment.paypal_cancel');
        }
    }
    public function paypal_success(Request $request)
    {
        $provider = new PayPalClient();
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $status = BillModel::where([
                'id' => $request->query('billModel')
            ])->first();
            $payment = PaymentModel::where([
                'slug' => 'paypal'
            ])->first();
            if (isset($status)) {
                $status->update([
                    'status' => 1,
                    'payment_id' => $payment->id,
                    'transaction_id' => $response['id']
                ]);
            }
            return redirect()->route('bill.detail', $request->query('billModel'))->with('success', 'Thanh toán bằng PayPal thành công!');
        } else {
            return redirect()->route('payment.paypal_cancel', ['billModel' => $request->query('billModel')]);
        }
    }
    public function paypal_cancel(Request $request)
    {
        return redirect()->route('bill.detail', $request->query('billModel'))->with('error', 'Thanh toán bằng PayPal thất bại!');
    }

    //Momo
    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function momo(Request $request)
    {

        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $total_price = explode('VNĐ', $request->total_price);
        $total_price = explode('.', $total_price[0]);
        $amount = implode('', $total_price);
        $amount = explode(' ', $amount);
        $amount = $amount[0] ?? $amount;
        $orderId = time() . "";
        $redirectUrl =  route('bill.detail',['billModel' => $request->bill_id]);
        $ipnUrl = route('bill.detail',['billModel' => $request->bill_id]);
        $extraData = "";

        $requestId = time() . "";
        $requestType = "payWithATM";
        // $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
        //before sign HMAC SHA256 signature
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);

        $result = $this->execPostRequest($endpoint, json_encode($data));

        $jsonResult = json_decode($result, true);  // decode json
        if (!isset($jsonResult['errorCode'])) {
            $status = BillModel::where([
                'id' => $request->bill_id
            ])->first();
            $payment = PaymentModel::where([
                'slug' => 'momo'
            ])->first();
            if (isset($status)) {
                $status->update([
                    'status' => 1,
                    'payment_id' => $payment->id,
                    'transaction_id' =>$jsonResult['orderId']
                ]);
            }
            return redirect()->to($jsonResult['payUrl'])->with('success', 'Thanh toán bằng MoMo thành công!');
        } else {
            return redirect()->back()->with('error', 'Thanh toán bằng MoMo thất bại!');
        }


    }
}
