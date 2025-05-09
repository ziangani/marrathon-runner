<?php

namespace App\Console\Commands;

use App\Integrations\WhatsAppService;
use App\Models\SmsNotifications;
use App\Models\WhatsAppNotifications;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class sendWhatsapp extends Command
{

    protected $signature = 'send-whatsapp';
    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $pendindMsgs = WhatsAppNotifications::whereIn('status', ['PENDING'])->orderBy('id', 'desc')->get();
        $this->info(count($pendindMsgs) . ' pending WhatsApp Messages found.');

        foreach ($pendindMsgs as $whatsapp) {
            try {
                $number = (double)$whatsapp->mobile;

                if (strlen($number) == 10) {
                    $number = '26' . $number;
                    $this->info($whatsapp->mobile . ' updated to: ' . $number);
                }
                if (strlen($number) == 9) {
                    $number = '260' . $number;
                    $this->info($whatsapp->mobile . ' updated to: ' . $number);
                }
                if ($whatsapp->type == WhatsAppNotifications::MESSAGE_TYPE_TEMPLATE) {
                    $response = $this->sendTemplate($whatsapp);
                } elseif ($whatsapp->type == WhatsAppNotifications::MESSAGE_TYPE_TEXT) {
                    $service = new WhatsAppService();
                    $response = $service->sendMessage($number, $whatsapp->message);
                } else {
                    $this->error('Format not supported');
                    continue;
                }
                $status = json_encode($response);

                $whatsapp->status = 'COMPLETE';
                $whatsapp->sent_at = now();
                $whatsapp->response = json_encode($response);
                $whatsapp->save();
                $this->info('SMS Successfully sent, status: ' . $status);


            } catch (\Exception $ex) {
                $this->error('Something went wrong: ' . $ex->getMessage() . ' ' . $ex->getFile());
                Log::error('Error sending SMS: ' . $ex->getMessage());
                $whatsapp->status = 'FAILED';
                $whatsapp->sent_at = now();
                $whatsapp->save();
            }
        }
    }

    public function sendTemplate(WhatsAppNotifications $sms)
    {
        $service = new WhatsAppService();
        $components = json_decode($sms->template_data, true);
        return $service->sendTemplate($sms->mobile, $sms->template, $components);
    }


}
