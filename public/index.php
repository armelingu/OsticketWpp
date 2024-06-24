<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Src\Controllers\WebhookController;

$webhookController = new WebhookController();
$webhookController->handleRequest();
