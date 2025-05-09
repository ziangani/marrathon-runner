<?php

namespace App\Common;

use App\Models\BotUserFud;
use App\Models\Logs\ApiLogs;
use App\Models\MerchantApplications;
use App\Models\Merchants;
use App\Models\PerformanceLogs;
use App\Models\WhatsAppSessions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Helpers
{
    public static function buildApiResponse($statusCode, $statusDescription)
    {
        return [
            'statusCode' => $statusCode,
            'statusDescription' => $statusDescription
        ];
    }

    public static function logApiRequest($request, $response, $request_time, $response_time, $source_ip, $entity_state, $new_state, $reference, $source_reference, $request_status, $request_type = '')
    {
        try {
            $log = new ApiLogs();
            $log->request = json_encode($request);
            $log->response = json_encode($response);
            $log->request_time = $request_time;
            $log->response_time = $response_time;
            $log->source_ip = $source_ip;
            $log->entity_state = json_encode($entity_state);
            $log->new_state = json_encode($new_state);
            $log->reference = $reference;
            $log->source_reference = $source_reference;
            $log->request_status = $request_status;
            $log->request_type = $request_type;
            $log->save();
        } catch (\Exception $e) {
//            throw new \Exception('something went wrong: ' . $e->getMessage());
        }
    }

    public static function generateUUID()
    {
        // Generate a random 16-byte binary string
        $data = random_bytes(16);

        // Set the version (4) and variant (10) bits
        $data[6] = chr(ord($data[6]) & 0x0F | 0x40); // Version 4
        $data[8] = chr(ord($data[8]) & 0x3F | 0x80); // Variant 10

        // Convert binary to a hexadecimal string
        $uuid = bin2hex($data);

        // Format the UUID as per the standard (8-4-4-12)
        $formatted_uuid = substr($uuid, 0, 8) . '-' . substr($uuid, 8, 4) . '-' . substr($uuid, 12, 4) . '-' . substr($uuid, 16, 4) . '-' . substr($uuid, 20, 12);

        return $formatted_uuid;
    }

    public static function timeAgo($timestamp)
    {
        $current_time = time();
        $time_diff = $current_time - strtotime($timestamp);

        $seconds = $time_diff;
        $minutes = $seconds / 60;
        $hours = $minutes / 60;
        $days = $hours / 24;
        $weeks = $days / 7;
        $months = $days / 30;
        $years = $days / 365;

        if ($seconds < 60) {
            return $seconds . " secs ago";
        } elseif ($minutes < 60) {
            return round($minutes) . " minutes ago";
        } elseif ($hours < 24) {
            return round($hours) . " hours ago";
        } elseif ($days < 7) {
            return round($days) . " days ago";
        } elseif ($weeks < 4) {
            return round($weeks) . " weeks ago";
        } elseif ($months < 12) {
            return round($months) . " months ago";
        } else {
            return round($years) . " years ago";
        }
    }

    public static function generateRandomHashM1()
    {
        return md5(openssl_random_pseudo_bytes(32));
    }

    public static function logBotUserFud($userId, $friendlyValue, $systemValue, $source, $type, $module)
    {
        try {
            $fud = new BotUserFud();
            $fud->user_id = $userId;
            $fud->system_value = $systemValue;
            $fud->friendly_value = $friendlyValue;
            $fud->source = $source;
            $fud->module = $module;
            $fud->type = $type;
            $fud->save();
        } catch (\Exception $e) {
            throw new \Exception('Something went wrong: ' . $e->getMessage());
        }
    }

    public static function getBotFud($userId, $source, $module, $type)
    {
        try {
            return

                DB::table('bot_user_fuds')
                    ->select('system_value', 'friendly_value')
                    ->where('user_id', $userId)
                    ->where('source', $source)
                    ->where('module', $module)
                    ->where('type', $type)
                    ->distinct()
                    ->limit(3)
                    ->pluck('system_value', 'friendly_value')
                    ->toArray();
        } catch (\Exception $e) {
            return [];
        }
    }

    public static function isValidZambianMobileNumber($mobile)
    {
        $zambian_mobile_regex = '/^(?:\+?26)?0[97][567]\d{7}$/';
        return preg_match($zambian_mobile_regex, $mobile);
    }

    public static function parseFloat(mixed $int)
    {
        return floatval(str_replace(',', '', $int));
    }


    public static function generateUploadReference(Merchants $merchant, MerchantApplications $merchant_app_id)
    {
        $merchant_id = $merchant->id;
        $merchant_app_id = $merchant_app_id->id;
        $date = date('YmdHis');
        $random = rand(1000, 9999);
        return $merchant_id . '-' . $merchant_app_id . '-' . $date . $random;
    }

    public static function slugify(string $string)
    {
        $string = strtolower($string);
        $string = str_replace(' ', '-', $string);
        return $string;
    }

    public static function generateSKU()
    {
        $date = date('YmdHis');
        $random = rand(1000, 9999);
        return $date . $random;
    }

    public static function generatePassword(int $length)
    {
        $chars = '23456789abcdefghkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

    public static function LogPerformance($type, $action, $description, $source_id, $source_type, $user_ip, $user_agent, $reference_1 = null, $reference_2 = null, $reference_3 = null, $details = null): void
    {
        try {
            //set session id
            $session_id = session()->getId();
            $log = new PerformanceLogs();
            $log->type = $type;
            $log->action = $action;
            $log->description = $description;
            $log->source_id = $source_id;
            $log->source_type = $source_type;
            $log->reference_1 = $reference_1;
            $log->reference_2 = $reference_2;
            $log->reference_3 = $reference_3;
            $log->user_ip = $user_ip;
            $log->user_agent = $user_agent;
            $log->session_id = $session_id;
            $log->details = json_encode($details);
            $log->save();
        } catch (\Exception $e) {
        }
    }

    public static function getUserIp()
    {
        return request()->ip();
    }

    public static function pluralize($text, $count)
    {
        if (str_ends_with($text, 's'))
            $text = substr($text, 0, -1);
        return $count . (($count == 1) ? (" $text") : (" $text" ."s"));
    }

    public static function validateNumberVsNetwork(mixed $item_id, $serviceProvider): bool|int
    {
        switch ($serviceProvider) {
            case 'MTN':
                //should match for 096 or 076
                return str_starts_with($item_id, '096') || str_starts_with($item_id, '076');
            case 'Airtel':
                //should match for 097 or 077
                return str_starts_with($item_id, '097') || str_starts_with($item_id, '077');
            case 'Zamtel':
                //should match for 095 or 075
                return str_starts_with($item_id, '095') || str_starts_with($item_id, '075');
            default:
                return false;
        }
    }

    public static function determineMobileNetwork($mobileNumber)
    {
        if (str_starts_with($mobileNumber, '096') || str_starts_with($mobileNumber, '076')) {
            return 'MTN';
        } elseif (str_starts_with($mobileNumber, '097') || str_starts_with($mobileNumber, '077')) {
            return 'Airtel';
        } elseif (str_starts_with($mobileNumber, '095') || str_starts_with($mobileNumber, '075')) {
            return 'Zamtel';
        } else {
            return 'Unknown';
        }
    }


    public static function logSession(string $session_id, string $msisdn, string $function, string $action, $session_data, string $request_reference, $sender, $request)
    {
        $session = new WhatsAppSessions();
        $session->session_id = $session_id;
        $session->mobile = $msisdn;
        $session->function = $function;
        $session->action = $action;
        $session->session_data = json_encode($session_data);
        $session->request_reference = $request_reference;
        $session->sender = $sender;
        $session->request = json_encode($request);
        $session->save();
        return $session;
    }

    public static function getLastSession(mixed $session_id, mixed $msisdn)
    {
        return WhatsAppSessions::where('session_id', $session_id)->where('mobile', $msisdn)->where('status', 'ACTIVE')->orderBy('created_at', 'desc')->first();
    }

    public static function endSession(string $session_id, string $msisdn)
    {
        WhatsAppSessions::where('session_id', $session_id)->where('mobile', $msisdn)->where('status', 'ACTIVE')
            ->update(
                [
                    'status' => 'INVALIDATED'
                ]
            );
    }

    public static function getGreetingSalutation(): string
    {
        //say Good morning, Good afternoon, Good evening
        $hour = date('H');
        if ($hour < 12) {
            return 'Good morning';
        } elseif ($hour < 17) {
            return 'Good afternoon';
        } else {
            return 'Good evening';
        }
    }

    public static function getByeSalutation()
    {
        //say Enjoy the rest of your day, Have a great day, Good evening, Good night
        $hour = date('H');
        if ($hour < 12) {
            return 'Enjoy the rest of your day';
        } elseif ($hour < 17) {
            return 'Have a great day';
        } elseif ($hour < 20) {
            return 'Good evening';
        } else {
            return 'Good night';
        }
    }

    public static function createBasicLog($channel, $message, $reference)
    {
        try {
            Log::channel($channel)->info($reference . ' | ' . $message);
        } catch (\Exception $e) {

        }

    }

}
