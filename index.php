<?php
session_start();

require_once 'Krypton\Krypton.php';
use Krypton\core\Client;

$_SESSION['CLIENT_ID'] = '1';
var_dump($_SESSION);

$client = Client::getInstance();

var_dump($client);
