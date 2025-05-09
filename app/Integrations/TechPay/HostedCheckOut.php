<?php

namespace App\Integrations\TechPay;

use App\Common\Helpers;
use App\Models\PaymentProviders;
use \Exception;

class HostedCheckOut
{
    private $endpoint;
    private $apiKey;
    private $apiAuth;
    private $provider;

    public function __construct(PaymentProviders $provider)
    {

        $this->endpoint = $provider->api_url;
        $this->apiKey = $provider->api_key;
        $this->apiAuth = $provider->api_secret;
        $this->provider = $provider;
    }

    public function getPaymentProvider()
    {
        return $this->provider;
    }

    public function getToken($amount, $reference, $description, $returnURL = null)
    {

        $params = [
            "orderNumber" => $reference,
            "description" => $description,
            "amount" => $amount,
            "merchantApiKey" => $this->apiKey,
            "merchantApiID" => $this->apiAuth,
            "returnURL" => $returnURL,
        ];

        $curl = curl_init();
        $url = $this->endpoint . '/api/v1/hc/gettoken';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json"
            ],
        ));
        $request_time = date('Y-m-d H:i:s');
        $result = curl_exec($curl);
        $errorCode = curl_errno($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        if ($errorCode != 0) {
            throw new Exception("Internal Connection failure; " . $curl_error);
        }

        try {
            $response = json_decode($result);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        Helpers::logApiRequest($params, $response, $request_time, date('Y-m-d H:i:s'), '', [], [], $reference, $reference, 'SUCCESS', 'TECHPAY_GET_TOKEN');
        if (!isset($response->responsecode)) {
            throw new Exception("The external system is temporarily unavailable - 500");
        }
        if ($response->responsecode != 100) {
            throw new Exception("Could not initiate payment: " . $response->responsemessage);
        }
        return $response->data->token;
    }


    public function getTransactionStatus($token)
    {

        $params = [
            "token" => $token,
            "merchantApiKey" => $this->apiKey,
            "merchantApiID" => $this->apiAuth,
        ];
        $curl = curl_init();
        $url = $this->endpoint . '/api/v1/hc/statuscheck';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 120,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => [
                "content-type: application/json"
            ],
        ));
        $request_time = date('Y-m-d H:i:s');
        $result = curl_exec($curl);
        $errorCode = curl_errno($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        if ($errorCode != 0) {
            throw new Exception("Internal Connection failure; " . $curl_error);
        }
        Helpers::logApiRequest($params, $result, $request_time, date('Y-m-d H:i:s'), '', [], [], $token, $token, 'SUCCESS', 'TECHPAY_GET_STATUS');
        try {
            $response = json_decode($result);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        if (!isset($response->responsecode)) {
            throw new Exception("The external system is temporarily unavailable - 500");
        }
        if (!in_array($response->responsecode, [100])) {
            throw new Exception("Could not initiate payment: " . $response->responsemessage);
        }
        return $response;
    }

    public function getEndpoint()
    {
        return $this->endpoint;
    }

    public function pushMobilePayment($mobile, $token)
    {
        if (strlen($mobile) == 12) {
            $mobile = substr($mobile, 2);
        }
        $params = [
            "token" => $token,
            "mobileNumber" => $mobile,
            "merchantApiKey" => $this->apiKey,
            "merchantApiID" => $this->apiAuth,
        ];

        $curl = curl_init();
        $url = $this->endpoint . '/api/v1/ic/pay/mobilemoney';
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        $request_time = date('Y-m-d H:i:s');
        $result = curl_exec($curl);
        $errorCode = curl_errno($curl);
        $curl_error = curl_error($curl);
        curl_close($curl);

        if ($errorCode != 0) {
            throw new Exception("Internal Connection failure; " . $curl_error);
        }
        Helpers::logApiRequest($params, $result, $request_time, date('Y-m-d H:i:s'), '', [], [], $token, $token, 'SUCCESS', 'TECHPAY_PUSH_MOBILE');
        try {
            $response = json_decode($result);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        if (!isset($response->responsecode)) {
            throw new Exception("The external system is temporarily unavailable - 500");
        }
        if ($response->responsecode != 100) {
            throw new Exception("Could not initiate payment: " . $response->responsemessage);
        }
        return $response;
    }
}
