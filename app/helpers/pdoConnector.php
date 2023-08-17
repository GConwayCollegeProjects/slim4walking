<?php

include "../private/config.php";

if ($server === "local") {
    $server = $localhost;
} else {
    $server = $remotehost;
}

$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false ) ;

$pdo = new PDO(
    "mysql:host=" . $server. ";dbname=" . $database, //DSN
    $username, //Username
    $password, //Password
    $options //Options
);
return $pdo;
