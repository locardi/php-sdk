<?php

ignore_user_abort(true);
set_time_limit(0);

require_once __DIR__ . '/../vendor/autoload.php';

use Locardi\PhpSdk\Authentication\JwtAuthentication\TokenStorage\FileTokenStorage;
use Locardi\PhpSdk\LocardiClient;
use Locardi\PhpSdk\Api\OrganizationUserRequestApi;

$client = new LocardiClient(array(
    'debug' => true,
    'username' => 'michael',
    'password' => 'michael',
    'tokenStorage' => new FileTokenStorage(__DIR__),
    'timeout' => 10, // default is 30 seconds
    'endpoint' => 'http://127.0.0.1:8089',
));

$client->send(array(
    'organization_user_request' => array(
        'request_type' => OrganizationUserRequestApi::REQUEST_TYPE_HTML_PAGE,
        'ip_address' => '8.8.8.8',
        'http_method' => 'GET',
        'timestamp' => date('c'),
        'user_agent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/57.0.2987.110 Safari/537.36',
        'uri' => 'https://www.getlocardi.com/?param1=value1&param2=value2',
        'organization' => array(
            'id' => '123', // note that this is a string
            'name' => 'Organization1',
        ),
        'user' => array(
            'id' => '123', // note that this is a string
            'name' => 'User1', // you can fill this field with the username,email or any other unique id
            'type' => OrganizationUserRequestApi::USER_TYPE_INTERNAL,
            'timezone' => 'Europe/London',
        ),
    ),
));

$client->send(array(
    'client_login_failed_unknown_username_request' => array(
        'ip_address' => '8.8.8.8',
        'http_method' => 'GET',
        'timestamp' => date('c'),
        'user_agent' => 'Mozilla\/5.0 (X11; Linux x86_64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/57.0.2987.110 Safari\/537.36',
        'uri' => 'https://www.getlocardi.com/?param1=value1&param2=value2',
        'user' => array(
            'name' => 'iamahacker', // this is the username or the email used for the login attempt
        )
    )
));
