<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
// create database connection
require_once('../m/Connection.php');

$Conn = new Connection();

$pdo = $Conn->newConnection();

//If the POST var "login" exists (our submit button), then we can
//assume that the user has submitted the login form.
if(isset($_POST['email'])){

    //Retrieve the field values from our login form.
    $email = !empty($_POST['email']) ? trim($_POST['email']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;

    //Retrieve the user account information for the given email.
    $sql = "SELECT ind_id, ind_firstname, ind_lastname, ind_img_id, ind_email, ind_pword FROM individuals WHERE ind_email = :email";
    $stmt = $pdo->prepare($sql);


    //Bind value.
    $stmt->bindValue(':email', $email);

    //Execute.
    $stmt->execute();

    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that email!
	    header('Location: ../../home.php');

    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.


        $pass=$user['ind_pword'];



        $validPassword=password_verify($passwordAttempt, $pass);


        //Compare the passwords.
       // $validPassword = password_verify($pass, $passwordAttempt);

        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
	        $date = date('Y-m-d H:i:s');
            //Provide the user with a login session.
            $_SESSION['userid'] = $user['ind_id'];
            $_SESSION['loggedin'] = $date;
            $_SESSION['username'] = $user['ind_firstname']." ".$user['ind_lastname'];
            // find profile picture if exists
	        if ($user['ind_img_id']!==null) {
		        $sql = "SELECT img_ext FROM images WHERE img_id = :id";

// prepare pdo
		        $stmt = $pdo->prepare($sql);

//Bind the provided email entry to our prepared statement.
		        $stmt->bindValue(':id', $user['ind_img_id']);

//Execute.
		        $stmt->execute();

//Fetch the row.
		        $result = $stmt->fetch(PDO::FETCH_ASSOC);

		        $ext = $result['img_ext'];

		        $_SESSION['userpic'] = trim($user['ind_img_id']) . "." . trim($ext);
	        }

		        // update ind_last_on
		        $sql = "UPDATE individuals SET ind_last_on = :last  WHERE ind_id = :id";

// prepare pdo
		        $stmt = $pdo->prepare($sql);

//Bind the provided email entry to our prepared statement.
		        $stmt->bindValue(':id', $user['ind_id']);
		        $stmt->bindValue(':last', $date);

//Execute.
		        $stmt->execute();


			// Cleanup
	        $pdo = null;
	        $Conn = null;

            //Redirect to our protected page, which we called home.html
            header('Location: ../../home.php');
            exit;

        }
        else{
	        header('Location: ../../home.php');
	        exit;

        }
    }

}

