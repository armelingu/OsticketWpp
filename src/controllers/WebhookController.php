<?php
namespace Src\Controllers;

use Src\Services\OsTicketService;
use Src\Services\WhatsAppService;

class WebhookController {
    public function handleRequest() {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        if (isset($data['entry'][0]['changes'][0]['value']['messages'][0])) {
            $message = $data['entry'][0]['changes'][0]['value']['messages'][0]['text']['body'];
            $from = $data['entry'][0]['changes'][0]['value']['messages'][0]['from'];

            $ticketService = new OsTicketService();
            $ticketService->createTicket($from, $message);

            $whatsappService = new WhatsAppService();
            $whatsappService->sendMessage($from, 'Seu chamado foi criado com sucesso.');
        }
    }
}
