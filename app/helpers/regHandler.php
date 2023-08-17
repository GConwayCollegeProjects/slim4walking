<?php

session_start();

//If the POST var "register" exists (our submit button), then we can
//assume that the user has submitted the registration form.

if (isset($_POST['name'])) {

    //Retrieve the field values from our registration form.

   $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
   $screen = !empty($_POST['screen']) ? trim($_POST['screen']) : null;
   $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
   $pass = !empty($_POST['password']) ? trim($_POST['password']) : null;
} else {
  die();
}

    require_once('../m/Registration.php');



    $Registration = new Registration();


    $Registration -> completeRegistration($name, $screen, $email, $pass);



    header('Refresh: 3; url=../../home.php');
?>
