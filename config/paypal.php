<?php
/**
 * Created by PhpStorm.
 * User: RSG
 * Date: 9/26/2017
 * Time: 4:32 PM
 */
return [
    'mode' => 'sandbox',        // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    'sandbox' => [
        'username' => 'webmasterdragon-facilitator-1_api1.outlook.com',       // Api Username
        'password' => 'PSQFXGCGWAU6XMUS',       // Api Password
        'secret' => 'EHcNSGdlxQx5jb3m2IYGjZb86I1qfXe_5PiKCXZnI6sOTj9btqSJFcAqjA4rqtHWXIdzOOxJvVi8P-hO',         // This refers to api signature
        'certificate' => '',    // Link to paypals cert file, storage_path('cert_key_pem.txt')
    ],
    'live' => [
        'username' => '',       // Api Username
        'password' => '',       // Api Password
        'secret' => '',         // This refers to api signature
        'certificate' => '',    // Link to paypals cert file, storage_path('cert_key_pem.txt')
    ],
    'payment_action' => 'Sale', // Can Only Be 'Sale', 'Authorization', 'Order'
    'currency' => 'USD',
    'notify_url' => '',         // Change this accordingly for your application.
];