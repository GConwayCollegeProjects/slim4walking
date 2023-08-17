<?php

$type = "";
$id = "";

if (isset($_POST['id'])) {
    $type = $_POST['type'];
    $id = $_POST['id'];
}
//echo '<script>console.log('.$type.')</script>';

require "../src/Connection.php";
require "../helpers/functions.php";

require __DIR__.'/../../../vendor/autoload.php';

use \Monolog\Logger;
use \Monolog\Handler\StreamHandler;

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler('../private/logs/app.log', Logger::DEBUG));

$logger->info('Started');

$conn = new Connection();

$pdo = $conn->newConnection();


switch ($type) {
    case 'details':
        include "details.php";
        return;
    case 'cohorts':
        include "cohorts.php";
        return;
    case 'text':
        include "text.php";
        return;
    default:
        include "routes.php";
        return;
}

