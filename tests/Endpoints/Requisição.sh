curl -X POST '10.0.101.46/api/tickets.json' \
-H 'X-API-KEY: A1D67690F612FCE67F2D7040997B20E9' \
-H 'Content-Type: application/json' \
-d '{
  "name": "insira seu nome aqui",
  "email": "insira seu email aqui",
  "subject": "insira o assunto",
  "message": "insira a mensagem aqui",
  "priority": "1"
}
