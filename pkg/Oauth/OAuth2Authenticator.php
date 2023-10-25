<?php
namespace Pkg\Oauth;

use Google_Client;
use Google_Service_Oauth2;

class OAuth2Authenticator {
    private $clientId;
    private $clientSecret;
    private $redirectUri;

    public function __construct($clientId, $clientSecret, $redirectUri) {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->redirectUri = $redirectUri;
    }

    public function exchangeCodeForAccessToken($code) {
        $client = new Google_Client();
        $client->setClientId($this->clientId);
        $client->setClientSecret($this->clientSecret);
        $client->setRedirectUri($this->redirectUri);

        // Exchange the authorization code for an access token
        $client->authenticate($code);
        return $client->getAccessToken();
    }
}
