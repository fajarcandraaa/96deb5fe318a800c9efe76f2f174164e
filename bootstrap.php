<?php
require 'vendor/autoload.php';
use Dotenv\Dotenv;

use Src\System\DatabaseConfiguration;

// This is credential from google cloud platform OAuth2
$clientId = ""; 
$clientSecret = "";
$callbackUri = "";
$tokenUri = "";

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

$dbConnection = (new DatabaseConfiguration())->getConnection();