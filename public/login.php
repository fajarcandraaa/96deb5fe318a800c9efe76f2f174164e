<?php

require '../bootstrap.php'; 

$authUrl = "https://accounts.google.com/o/oauth2/auth";
$authUrl .= "?scope=email%20profile";
$authUrl .= "&redirect_uri=" . urlencode($callbackUri);
$authUrl .= "&response_type=code";
$authUrl .= "&client_id=" . $clientId;
$authUrl .= "&access_type=offline"; 

header('Location: ' . $authUrl);
?>
