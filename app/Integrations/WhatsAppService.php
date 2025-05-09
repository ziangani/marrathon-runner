<?php

namespace App\Integrations;

use Illuminate\Support\Facades\Http;

class WhatsAppService
{
    private string $graphApiToken;
    private string $endpoint;

    public function __construct()
    {
        $this->graphApiToken = config('whatsapp.token');
        $this->endpoint = config('whatsapp.url');
    }

    //send button template message
    public function sendMessageWithButtons(string $businessPhoneNumberId, string $from, string $messageId, string $body, array $buttonsList)
    {
        $buttons = array_map(function ($id, $title) {
            return [
                'type' => 'reply',
                'reply' => [
                    'id' => $id,
                    'title' => substr($title, 0, 20)
                ]
            ];
        }, array_keys($buttonsList), $buttonsList);
        $buttons = array_slice($buttons, 0, 3);

        Http::withToken($this->graphApiToken)
            ->timeout(30)
            ->post($this->endpoint . "/{$businessPhoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $from,
                'recipient_type' => 'individual',
                'type' => 'interactive',
                'interactive' => [
                    'type' => 'button',
                    'body' => [
                        'text' => $body
                    ],
                    'action' => [
                        'buttons' => $buttons
                    ]
                ],
                'context' => [
                    'message_id' => $messageId,
                ],
            ]);
    }

    public function sendMessage(string $businessPhoneNumberId, string $from, string $messageId, string $text)
    {

        $response = Http::withToken($this->graphApiToken)
            ->timeout(30)
            ->post($this->endpoint . "/{$businessPhoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $from,
                'text' => ['body' => $text],
                'context' => [
                    'message_id' => $messageId,
                ],
            ]);
    }

    public function markMessageAsRead(string $businessPhoneNumberId, string $messageId)
    {
        Http::withToken($this->graphApiToken)
            ->timeout(30)
            ->post($this->endpoint . "/{$businessPhoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'status' => 'read',
                'message_id' => $messageId,
            ]);
    }

    public function getMessageText(array $message)
    {
        if ($message['type'] === 'text') {
            return $message['text']['body'];
        } elseif ($message['type'] === 'image') {
            return $message['image']['caption'];
        } elseif ($message['type'] === 'document') {
            return $message['document']['caption'];
        } elseif ($message['type'] === 'location') {
            return $message['location']['name'];
        } elseif ($message['type'] === 'button') {
            return $message['button']['text'];
        } elseif ($message['type'] === 'interactive') {
            return isset($message['interactive']['button_reply']) ? $message['interactive']['button_reply']['id'] : $message['interactive']['list_reply']['id'];
        }
        return '';
    }


    public function sendDocument(string $businessPhoneNumberId, string $from, string $messageId, string $caption, string $filename, string $link)
    {

        $res = Http::withToken($this->graphApiToken)
            ->timeout(30)
            ->post($this->endpoint . "/{$businessPhoneNumberId}/messages", [
                'recipient_type' => 'individual',
                'messaging_product' => 'whatsapp',
                'to' => $from,
                'type' => 'document',
                'document' => [
                    'caption' => $caption,
                    'filename' => $filename,
                    'link' => $link
                ],
                'context' => [
                    'message_id' => $messageId,
                ],
            ]);
        return $res->json();
    }

    //sender biller menu

//    protected const paymentCategories = [
//        1 => 'Airtime Direct Top-up',
//        2 => 'Zesco Token Purchase',
//        3 => 'DStv Top-up',
//        4 => 'GOtv Top-up',
//        5 => 'TopStar Top-up',
//    ];
//
////Airtel	Direct-Topup	EF52DTHN2
////MTN	Direct-Topup	EF52DDRS7
////Zamtel	Direct-Topup	EF1GHRID1
//
//    protected const mobileNetworkVouchers = [
//        'Airtel' => 'EF52DTHN2',
//        'MTN' => 'EF52DDRS7',
//        'Zamtel' => 'EF1GHRID1',
//    ];
//    protected const paymentCategoriesSP = [
//        1 => 'Airtel/Mtn/Zamtel',
//        2 => 'Zesco',
//        3 => 'DStv',
//        4 => 'GOtv',
//        5 => 'TopStar',
//    ];
//
//    //'EM3GAQAR2',//DStv-Box office
//    //'ELOA1SA26',//DStv
//    //'ELOA1XKZ1',//GOtv
//    //'EWNHCYE11',//Topstar

    public function sendBillerMenu(string $businessPhoneNumberId, string $from, string $messageId, string $body)
    {
        $sections = [
            [
                'title' => "Airtime Purchase",
                'rows' => [
                    [
                        'id' => "Airtime Purchase",
                        'title' => "Direct Top-up",
                        'description' => "Purchase airtime for on Airtel, MTN or Zamtel"
                    ],
                ]
            ],
            [
                'title' => "Zesco Token Purchase",
                'rows' => [
                    [
                        'id' => "Zesco",
                        'title' => "Zesco",
                        'description' => "Purchase Zesco tokens"
                    ]
                ]
            ],
            [
                'title' => "TV Subscriptions",
                'rows' => [
                    [
                        'id' => "DStv",
                        'title' => "DStv",
                        'description' => "Top-up your DStv account"
                    ],
                    [
                        'id' => "GOtv",
                        'title' => "GOtv",
                        'description' => "Top-up your GOtv account"
                    ],
                    [
                        'id' => "TopStar",
                        'title' => "TopStar",
                        'description' => "Top-up your TopStar account"
                    ]
                ]
            ],
        ];

        $res = Http::withToken($this->graphApiToken)
            ->timeout(30)
            ->post($this->endpoint . "/{$businessPhoneNumberId}/messages", [
                'messaging_product' => 'whatsapp',
                'to' => $from,
                'recipient_type' => 'individual',
                'type' => 'interactive',
                'interactive' => [
                    'type' => 'list',
                    'header' => [
                        'type' => 'text',
                        'text' => "Welcome to " . config('app.friendly_name')
                    ],
                    'body' => [
                        'text' => $body
                    ],
                    'footer' => [
                        'text' => "Powered by " . config('app.powered_by')
                    ],
                    'action' => [
                        'button' => "Get Started",
                        'sections' => $sections
                    ]
                ],
                'context' => [
                    'message_id' => $messageId,
                ],
            ]);
        if ($res->status() != 200)
            throw new \Exception('Failed to send biller menu' . $res->body());
    }

}
