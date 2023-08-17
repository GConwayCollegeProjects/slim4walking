<?php

require '../../vendor/autoload.php';

use Cohortology\Leftbox;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['val'])) {
    $val = $_POST['val'];
    $leftbox = new Leftbox();
    $result = $leftbox->fillLeftbox($val);
    echo $result;
}
