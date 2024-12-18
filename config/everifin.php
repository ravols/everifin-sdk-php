<?php

return [
    'client_id' => getenv('EVERIFIN_CLIENT_ID'),
    'client_secret' => getenv('EVERIFIN_CLIENT_SECRET'),
    'client_iban' => getenv('EVERIFIN_CLIENT_IBAN'),
    'order_endpoint' => 'https://pay.everifin.com/api/v2/orders',
    'order_payment_endpoint' => 'https://pay.everifin.com/api/v2/orders/',
    'payment_endpoint' => 'https://pay.everifin.com/api/v2/payments',
    'access_token_endpoint' => 'https://app.everifin.com/auth/realms/everifin_paygate/protocol/openid-connect/token',
];
