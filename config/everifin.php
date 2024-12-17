<?php

return [
    'client_id' => $_ENV['EVERIFIN_CLIENT_ID'],
    'client_secret' => $_ENV['EVERIFIN_CLIENT_SECRET'],
    'client_iban' => $_ENV['EVERIFIN_CLIENT_IBAN'],
    'order_endpoint' => 'https://pay.everifin.com/api/v2/orders',
    'order_payment_endpoint' => 'https://pay.everifin.com/api/v2/orders/',
    'payment_endpoint' => 'https://pay.everifin.com/api/v2/payments',
];
