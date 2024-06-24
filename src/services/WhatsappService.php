<?php
namespace Src\Services;

class WhatsAppService {
    private $config;

    public function __construct() {
        $this->config = include __DIR__ . '/../../config/config.php';
    }

    public function sendMessage($to, $message) {
        $data = [
            'messaging_product' => 'whatsapp',
            'to' => $to,
            'type' => 'text',
            'text' => [
                'body' => $message
            ]
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['whatsapp']['api_url'] . $this->config['whatsapp']['phone_number_id'] . '/messages');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->config['whatsapp']['access_token'],
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
