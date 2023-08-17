<?php

require '../../vendor/autoload.php';

use Cohortology\Rightbox;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_POST['val'])) {
    $val = $_POST['val'];
    $rightbox = new Rightbox();
    $result = $rightbox->fillRightbox($val);
    echo $result;
}
