<?php
require '../bootstrap.php'; // Load your composer autoload file

use Pkg\Oauth\OAuth2Authenticator;
$oauth2 = new OAuth2Authenticator($clientId, $clientSecret, $callbackUri);

if (isset($_GET['code'])) {
    $authorizationCode = $_GET['code'];
    $accessToken = $oauth2->exchangeCodeForAccessToken($authorizationCode);

} else {
    echo "Authentication failed";
    exit();
}

