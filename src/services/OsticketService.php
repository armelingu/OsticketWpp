<?php
namespace Src\Services;

class OsTicketService {
    private $config;

    public function __construct() {
        $this->config = include __DIR__ . '/../../config/config.php';
    }

    public function createTicket($from, $message) {
        $ticketData = [
            'name' => $from,
            'email' => 'default@example.com',
            'subject' => 'Novo chamado via WhatsApp',
            'message' => $message
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->config['osticket']['url']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($ticketData));
        curl_setopt($ch, CURLOPT_USERAGENT, 'osTicket API Client v1.14');
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Expect:',
            'X-API-Key: ' . $this->config['osticket']['key'],
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}
